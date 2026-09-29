<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\ManagesCmsPage;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageHomeContent extends Page
{
    use ManagesCmsPage;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;

    protected static string|UnitEnum|null $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Home Content';

    protected static ?string $title = 'Homepage Content';

    protected static ?string $slug = 'home-content';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    protected static function pageSlug(): string
    {
        return 'home';
    }

    protected static function sectionKeys(): array
    {
        return ['hero', 'metrics', 'philosophy', 'triad', 'simulator', 'process', 'intake'];
    }

    public function mount(): void
    {
        $this->form->fill($this->loadCmsFormData());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->operation('edit')
            ->statePath('data');
    }

    protected function normalizeCmsFormData(array $data): array
    {
        foreach (['usual_items', 'mp_items'] as $listKey) {
            if (isset($data['philosophy'][$listKey]) && is_array($data['philosophy'][$listKey])) {
                $data['philosophy'][$listKey] = $this->wrapTextList($data['philosophy'][$listKey]);
            }
        }

        return $data;
    }

    protected function prepareCmsFormDataForSave(array $data): array
    {
        if (isset($data['philosophy'])) {
            foreach (['usual_items', 'mp_items'] as $listKey) {
                if (isset($data['philosophy'][$listKey])) {
                    $data['philosophy'][$listKey] = $this->unwrapTextList($data['philosophy'][$listKey]);
                }
            }

            // Keep mirrored left/right cards in sync with primary fields.
            $data['philosophy']['left'] = [
                'badge' => $data['philosophy']['usual_label'] ?? data_get($data, 'philosophy.left.badge'),
                'title' => $data['philosophy']['usual_title'] ?? data_get($data, 'philosophy.left.title'),
                'body' => $data['philosophy']['usual_body'] ?? data_get($data, 'philosophy.left.body'),
                'items' => $data['philosophy']['usual_items'] ?? [],
            ];
            $data['philosophy']['right'] = [
                'badge' => $data['philosophy']['mp_label'] ?? data_get($data, 'philosophy.right.badge'),
                'title' => $data['philosophy']['mp_title'] ?? data_get($data, 'philosophy.right.title'),
                'body' => $data['philosophy']['mp_body'] ?? data_get($data, 'philosophy.right.body'),
                'items' => $data['philosophy']['mp_items'] ?? [],
            ];
        }

        if (isset($data['hero']['console_modes'])) {
            $data['hero']['modes'] = $data['hero']['console_modes'];
            $attract = $data['hero']['console_modes']['attract'] ?? [];
            $data['hero']['hero_subhead_default'] = $attract['subhead'] ?? data_get($data, 'hero.hero_subhead_default');
            $data['hero']['hero_status_default'] = $attract['status'] ?? data_get($data, 'hero.hero_status_default');
            $data['hero']['nodes_default'] = $attract['cards'] ?? data_get($data, 'hero.nodes_default', []);
        }

        if (isset($data['triad']['pillars']['p1'])) {
            $p1 = $data['triad']['pillars']['p1'];
            $data['triad']['default_badge'] = $p1['badge'] ?? data_get($data, 'triad.default_badge');
            $data['triad']['default_title'] = $p1['title'] ?? data_get($data, 'triad.default_title');
            $data['triad']['default_desc'] = $p1['desc'] ?? data_get($data, 'triad.default_desc');
            $data['triad']['default_metric_1'] = $p1['m1Val'] ?? data_get($data, 'triad.default_metric_1');
            $data['triad']['default_metric_2'] = $p1['m2Val'] ?? data_get($data, 'triad.default_metric_2');
            $data['triad']['default_telemetry'] = $p1['telemetry'] ?? data_get($data, 'triad.default_telemetry');
            $data['triad']['flow_label'] = $p1['flowLabel'] ?? data_get($data, 'triad.flow_label');
            $data['triad']['cta_label'] = $p1['cta'] ?? data_get($data, 'triad.cta_label');
            $data['triad']['default_stages'] = $p1['stages'] ?? data_get($data, 'triad.default_stages', []);
        }

        if (isset($data['simulator'])) {
            $data['simulator']['default_employees'] = (int) ($data['simulator']['default_employees'] ?? 7);
            $data['simulator']['default_manual_percent'] = (int) ($data['simulator']['default_manual_percent'] ?? 20);
            $data['simulator']['default_revenue_percent'] = (int) ($data['simulator']['default_revenue_percent'] ?? 80);
            $data['simulator']['default_salary'] = (int) ($data['simulator']['default_salary'] ?? 50000);
            $data['simulator']['default_monthly_revenue'] = (int) ($data['simulator']['default_monthly_revenue'] ?? 1000000);
            $data['simulator']['defaults'] = [
                'employees' => $data['simulator']['default_employees'],
                'manual' => $data['simulator']['default_manual_percent'],
                'revenue_work' => $data['simulator']['default_revenue_percent'],
                'team_cost' => $data['simulator']['default_salary'],
                'monthly_revenue' => $data['simulator']['default_monthly_revenue'],
            ];
        }

        if (isset($data['metrics']['cards']) && empty($data['metrics']['items'])) {
            $data['metrics']['items'] = collect($data['metrics']['cards'])
                ->map(fn (array $card) => [
                    'icon' => $card['icon'] ?? null,
                    'value' => $card['stat'] ?? null,
                    'title' => $card['title'] ?? null,
                    'description' => $card['body'] ?? null,
                ])
                ->all();
        }

        return $data;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Home')
                ->persistTabInQueryString()
                ->columnSpanFull()
                ->tabs([
                    Tab::make('Hero')->schema([
                        Section::make('Hero copy')->columns(2)->schema([
                            Textarea::make('hero.title_html')
                                ->label('Headline HTML')
                                ->helperText('Use spans for highlighted words if needed.')
                                ->rows(3)
                                ->columnSpanFull(),
                            Textarea::make('hero.subhead')->label('Subhead')->rows(3)->columnSpanFull(),
                            TextInput::make('hero.cta_primary_label')->label('Primary CTA'),
                            TextInput::make('hero.cta_secondary_label')->label('Secondary CTA'),
                            TextInput::make('hero.trust_note')->label('Trust note')->columnSpanFull(),
                            TextInput::make('hero.console_title')->label('Console title')->columnSpanFull(),
                        ]),
                        Section::make('Attract mode')->collapsed()->schema([
                            TextInput::make('hero.console_modes.attract.subhead')->label('Subhead'),
                            TextInput::make('hero.console_modes.attract.status')->label('Status')->columnSpanFull(),
                            Repeater::make('hero.console_modes.attract.cards')->label('Cards')->schema([
                                TextInput::make('tag')->required(),
                                TextInput::make('title')->required(),
                                Textarea::make('desc')->label('Description')->rows(2)->columnSpanFull(),
                            ])->columns(2)->defaultItems(0)->collapsible()->columnSpanFull(),
                        ])->columns(2),
                        Section::make('Convert mode')->collapsed()->schema([
                            TextInput::make('hero.console_modes.convert.subhead')->label('Subhead'),
                            TextInput::make('hero.console_modes.convert.status')->label('Status')->columnSpanFull(),
                            Repeater::make('hero.console_modes.convert.cards')->label('Cards')->schema([
                                TextInput::make('tag')->required(),
                                TextInput::make('title')->required(),
                                Textarea::make('desc')->label('Description')->rows(2)->columnSpanFull(),
                            ])->columns(2)->defaultItems(0)->collapsible()->columnSpanFull(),
                        ])->columns(2),
                        Section::make('Optimize mode')->collapsed()->schema([
                            TextInput::make('hero.console_modes.optimize.subhead')->label('Subhead'),
                            TextInput::make('hero.console_modes.optimize.status')->label('Status')->columnSpanFull(),
                            Repeater::make('hero.console_modes.optimize.cards')->label('Cards')->schema([
                                TextInput::make('tag')->required(),
                                TextInput::make('title')->required(),
                                Textarea::make('desc')->label('Description')->rows(2)->columnSpanFull(),
                            ])->columns(2)->defaultItems(0)->collapsible()->columnSpanFull(),
                        ])->columns(2),
                    ]),
                    Tab::make('Metrics')->schema([
                        Section::make('Metric cards')->schema([
                            Repeater::make('metrics.cards')->label('Cards')->schema([
                                TextInput::make('icon')->helperText('Material icon name'),
                                TextInput::make('stat')->label('Stat'),
                                TextInput::make('title')->required(),
                                Textarea::make('body')->label('Body')->rows(2)->columnSpanFull(),
                                TextInput::make('icon_bg')->label('Icon classes')->columnSpanFull(),
                                TextInput::make('float')->label('Float class'),
                            ])->columns(2)->defaultItems(0)->collapsible()->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Philosophy')->schema([
                        Section::make('Section intro')->columns(2)->schema([
                            TextInput::make('philosophy.eyebrow')->label('Eyebrow'),
                            TextInput::make('philosophy.heading')->label('Heading')->columnSpanFull(),
                            Textarea::make('philosophy.intro')->label('Intro')->rows(3)->columnSpanFull(),
                            TextInput::make('philosophy.cta_label')->label('CTA label')->columnSpanFull(),
                        ]),
                        Section::make('Usual approach')->columns(2)->schema([
                            TextInput::make('philosophy.usual_label')->label('Label'),
                            TextInput::make('philosophy.usual_title')->label('Title')->columnSpanFull(),
                            Textarea::make('philosophy.usual_body')->label('Body')->rows(3)->columnSpanFull(),
                            Repeater::make('philosophy.usual_items')->label('Points')->schema([
                                TextInput::make('text')->required()->label('Point'),
                            ])->defaultItems(0)->reorderable()->columnSpanFull(),
                        ]),
                        Section::make('Market Princeps approach')->columns(2)->schema([
                            TextInput::make('philosophy.mp_label')->label('Label'),
                            TextInput::make('philosophy.mp_title')->label('Title')->columnSpanFull(),
                            Textarea::make('philosophy.mp_body')->label('Body')->rows(3)->columnSpanFull(),
                            Repeater::make('philosophy.mp_items')->label('Points')->schema([
                                TextInput::make('text')->required()->label('Point'),
                            ])->defaultItems(0)->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Capabilities')->schema([
                        Section::make('Section intro')->columns(2)->schema([
                            TextInput::make('triad.eyebrow')->label('Eyebrow'),
                            TextInput::make('triad.heading')->label('Heading')->columnSpanFull(),
                            Textarea::make('triad.intro')->label('Intro')->rows(3)->columnSpanFull(),
                            TextInput::make('triad.tab1_label')->label('Tab 1'),
                            TextInput::make('triad.tab2_label')->label('Tab 2'),
                            TextInput::make('triad.tab3_label')->label('Tab 3'),
                        ]),
                        $this->pillarSection('p1', 'Pillar 1 — Marketing'),
                        $this->pillarSection('p2', 'Pillar 2 — Technology'),
                        $this->pillarSection('p3', 'Pillar 3 — Optimization'),
                    ]),
                    Tab::make('Simulator')->schema([
                        Section::make('Copy')->columns(2)->schema([
                            TextInput::make('simulator.eyebrow')->label('Eyebrow'),
                            TextInput::make('simulator.heading')->label('Heading')->columnSpanFull(),
                            Textarea::make('simulator.intro')->label('Intro')->rows(3)->columnSpanFull(),
                            TextInput::make('simulator.output_title')->label('Output title')->columnSpanFull(),
                            Textarea::make('simulator.output_desc')->label('Output description')->rows(2)->columnSpanFull(),
                            TextInput::make('simulator.cta_label')->label('CTA label')->columnSpanFull(),
                        ]),
                        Section::make('Default values')->columns(2)->schema([
                            TextInput::make('simulator.default_employees')->numeric()->label('Team size'),
                            TextInput::make('simulator.default_manual_percent')->numeric()->label('Manual work %'),
                            TextInput::make('simulator.default_revenue_percent')->numeric()->label('Revenue-focused %'),
                            TextInput::make('simulator.default_salary')->numeric()->label('Avg resource cost'),
                            TextInput::make('simulator.default_monthly_revenue')->numeric()->label('Monthly revenue')->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Process')->schema([
                        Section::make('Process')->columns(2)->schema([
                            TextInput::make('process.eyebrow')->label('Eyebrow'),
                            TextInput::make('process.heading')->label('Heading')->columnSpanFull(),
                            Textarea::make('process.intro')->label('Intro')->rows(3)->columnSpanFull(),
                            TextInput::make('process.cta_label')->label('CTA label'),
                            TextInput::make('process.cta_note')->label('CTA note'),
                            Repeater::make('process.steps')->label('Steps')->schema([
                                TextInput::make('number')->label('Number')->maxLength(4),
                                TextInput::make('icon')->label('Icon'),
                                TextInput::make('title')->required()->columnSpanFull(),
                                Textarea::make('body')->label('Body')->rows(3)->columnSpanFull(),
                                TextInput::make('footer_label')->label('Footer label'),
                                TextInput::make('footer_icon')->label('Footer icon'),
                            ])->columns(2)->defaultItems(0)->collapsible()->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Intake')->schema([
                        Section::make('Intake form section')->columns(2)->schema([
                            TextInput::make('intake.badge')->label('Badge'),
                            TextInput::make('intake.heading')->label('Heading')->columnSpanFull(),
                            Textarea::make('intake.intro')->label('Intro')->rows(3)->columnSpanFull(),
                            TextInput::make('intake.aside_title')->label('Aside title'),
                            Textarea::make('intake.aside_body')->label('Aside body')->rows(2)->columnSpanFull(),
                            TextInput::make('intake.submit_label')->label('Submit label'),
                            TextInput::make('intake.success_message')->label('Success message')->columnSpanFull(),
                            Repeater::make('intake.highlights')->label('Highlights')->schema([
                                TextInput::make('icon'),
                                TextInput::make('title')->required(),
                                Textarea::make('body')->rows(2)->columnSpanFull(),
                            ])->columns(2)->defaultItems(0)->collapsible()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('SEO')->schema([
                        Section::make('Page SEO')->columns(2)->schema([
                            TextInput::make('title')->label('Page title')->required(),
                            Toggle::make('is_published')->label('Published')->default(true),
                            TextInput::make('meta_title')->maxLength(70)->columnSpanFull(),
                            Textarea::make('meta_description')->rows(3)->maxLength(160)->columnSpanFull(),
                            TextInput::make('meta_keywords')->columnSpanFull(),
                            TextInput::make('og_title'),
                            Textarea::make('og_description')->rows(2),
                            FileUpload::make('og_image')->image()->directory('seo')->disk('public')->columnSpanFull(),
                            TextInput::make('canonical_url')->url(),
                            TextInput::make('robots')->default('index, follow'),
                            Textarea::make('schema_markup')->rows(6)->label('Schema JSON-LD')->columnSpanFull(),
                        ]),
                    ]),
                ]),
        ]);
    }

    protected function pillarSection(string $key, string $label): Section
    {
        return Section::make($label)->collapsed()->columns(2)->schema([
            TextInput::make("triad.pillars.{$key}.badge")->label('Badge')->columnSpanFull(),
            TextInput::make("triad.pillars.{$key}.title")->label('Title')->columnSpanFull(),
            Textarea::make("triad.pillars.{$key}.desc")->label('Description')->rows(4)->columnSpanFull(),
            TextInput::make("triad.pillars.{$key}.m1Val")->label('Metric 1'),
            TextInput::make("triad.pillars.{$key}.m2Val")->label('Metric 2'),
            TextInput::make("triad.pillars.{$key}.telemetry")->label('Telemetry'),
            TextInput::make("triad.pillars.{$key}.flowLabel")->label('Flow label'),
            TextInput::make("triad.pillars.{$key}.cta")->label('CTA label')->columnSpanFull(),
            Repeater::make("triad.pillars.{$key}.stages")->label('Stages')->schema([
                TextInput::make('n')->label('#')->maxLength(4),
                TextInput::make('name')->required(),
                TextInput::make('val')->label('Value'),
            ])->columns(3)->defaultItems(0)->collapsible()->columnSpanFull(),
        ]);
    }

    public function save(): void
    {
        $this->saveCmsFormData($this->form->getState());

        Notification::make()
            ->success()
            ->title('Homepage content saved')
            ->send();
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Form::make([EmbeddedSchema::make('form')])
                ->id('form')
                ->livewireSubmitHandler('save')
                ->footer([
                    Actions::make([
                        Action::make('save')
                            ->label('Save homepage content')
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }
}
