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
class ManageAboutContent extends Page
{
    use ManagesCmsPage;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static string|UnitEnum|null $navigationGroup = 'About Page';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'About Content';

    protected static ?string $title = 'About Page Content';

    protected static ?string $slug = 'about-content';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    protected static function pageSlug(): string
    {
        return 'about';
    }

    protected static function sectionKeys(): array
    {
        return ['hero', 'origin', 'triad', 'doctrine', 'existence', 'cta'];
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
        foreach (['hero', 'origin', 'existence'] as $section) {
            if (isset($data[$section]['paragraphs']) && is_array($data[$section]['paragraphs'])) {
                $data[$section]['paragraphs'] = $this->wrapTextList($data[$section]['paragraphs']);
            }
        }

        if (isset($data['cta']['trust_items']) && is_array($data['cta']['trust_items'])) {
            $data['cta']['trust_items'] = $this->wrapTextList($data['cta']['trust_items']);
        }

        if (isset($data['triad']['pillars']) && is_array($data['triad']['pillars'])) {
            foreach ($data['triad']['pillars'] as $i => $pillar) {
                if (isset($pillar['points']) && is_array($pillar['points'])) {
                    $data['triad']['pillars'][$i]['points'] = $this->wrapTextList($pillar['points']);
                }
            }
        }

        return $data;
    }

    protected function prepareCmsFormDataForSave(array $data): array
    {
        foreach (['hero', 'origin', 'existence'] as $section) {
            if (isset($data[$section]['paragraphs'])) {
                $data[$section]['paragraphs'] = $this->unwrapTextList($data[$section]['paragraphs']);
            }
        }

        if (isset($data['cta']['trust_items'])) {
            $data['cta']['trust_items'] = $this->unwrapTextList($data['cta']['trust_items']);
        }

        if (isset($data['triad']['pillars']) && is_array($data['triad']['pillars'])) {
            foreach ($data['triad']['pillars'] as $i => $pillar) {
                if (isset($pillar['points'])) {
                    $data['triad']['pillars'][$i]['points'] = $this->unwrapTextList($pillar['points']);
                }
            }
        }

        return $data;
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('About')
                ->persistTabInQueryString()
                ->columnSpanFull()
                ->tabs([
                    Tab::make('Hero')->schema([
                        Section::make('Hero')->columns(2)->schema([
                            Textarea::make('hero.title_html')->label('Title HTML')->rows(3)->columnSpanFull(),
                            TextInput::make('hero.shaped_label')->label('Shaped label'),
                            TextInput::make('hero.shaped_text')->label('Shaped text')->columnSpanFull(),
                            TextInput::make('hero.cta_primary_label')->label('Primary CTA'),
                            TextInput::make('hero.cta_primary_url')->label('Primary CTA URL'),
                            TextInput::make('hero.cta_secondary_label')->label('Secondary CTA'),
                            TextInput::make('hero.cta_secondary_url')->label('Secondary CTA URL'),
                            Repeater::make('hero.paragraphs')->label('Paragraphs')->schema([
                                Textarea::make('text')->required()->rows(3)->label('Paragraph'),
                            ])->defaultItems(0)->reorderable()->columnSpanFull(),
                            Repeater::make('hero.stats')->label('Stats')->schema([
                                TextInput::make('icon'),
                                TextInput::make('value')->label('Value'),
                                TextInput::make('title')->required(),
                                Textarea::make('description')->rows(2)->columnSpanFull(),
                            ])->columns(2)->defaultItems(0)->collapsible()->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Origin')->schema([
                        Section::make('Origin story')->columns(2)->schema([
                            TextInput::make('origin.eyebrow')->label('Eyebrow'),
                            Textarea::make('origin.title_html')->label('Title HTML')->rows(2)->columnSpanFull(),
                            Repeater::make('origin.paragraphs')->label('Paragraphs')->schema([
                                Textarea::make('text')->required()->rows(3)->label('Paragraph'),
                            ])->defaultItems(0)->reorderable()->columnSpanFull(),
                            TextInput::make('origin.standard.badge')->label('Standard badge'),
                            TextInput::make('origin.standard.title')->label('Standard title')->columnSpanFull(),
                            Textarea::make('origin.standard.body')->label('Standard body')->rows(3)->columnSpanFull(),
                            TextInput::make('origin.codex.title')->label('Codex title'),
                            TextInput::make('origin.codex.subtitle')->label('Codex subtitle')->columnSpanFull(),
                            TextInput::make('origin.codex.footer_left')->label('Codex footer left'),
                            TextInput::make('origin.codex.footer_right')->label('Codex footer right'),
                            Repeater::make('origin.codex.items')->label('Codex items')->schema([
                                TextInput::make('num')->label('Number'),
                                TextInput::make('title')->required(),
                                Textarea::make('desc')->label('Description')->rows(2)->columnSpanFull(),
                                Toggle::make('active')->label('Active highlight')->default(false),
                            ])->columns(2)->defaultItems(0)->collapsible()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Triad')->schema([
                        Section::make('About triad')->columns(2)->schema([
                            TextInput::make('triad.eyebrow')->label('Eyebrow'),
                            TextInput::make('triad.title')->label('Title')->columnSpanFull(),
                            Textarea::make('triad.subtitle')->label('Subtitle')->rows(2)->columnSpanFull(),
                            TextInput::make('triad.footer_note')->label('Footer note')->columnSpanFull(),
                            Repeater::make('triad.pillars')->label('Pillars')->schema([
                                TextInput::make('icon'),
                                TextInput::make('badge'),
                                TextInput::make('title')->required()->columnSpanFull(),
                                Textarea::make('description')->rows(3)->columnSpanFull(),
                                TextInput::make('cta_label')->label('CTA label'),
                                TextInput::make('cta_url')->label('CTA URL'),
                                Repeater::make('points')->label('Points')->schema([
                                    TextInput::make('text')->required()->label('Point'),
                                ])->defaultItems(0)->columnSpanFull(),
                            ])->columns(2)->defaultItems(0)->collapsible()->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Doctrine')->schema([
                        Section::make('Doctrine')->columns(2)->schema([
                            TextInput::make('doctrine.eyebrow')->label('Eyebrow'),
                            TextInput::make('doctrine.title')->label('Title')->columnSpanFull(),
                            Textarea::make('doctrine.subtitle')->label('Subtitle')->rows(2)->columnSpanFull(),
                            Repeater::make('doctrine.items')->label('Items')->schema([
                                TextInput::make('number')->label('Number'),
                                TextInput::make('title')->required()->columnSpanFull(),
                                Textarea::make('description')->rows(3)->columnSpanFull(),
                                TextInput::make('footer_label')->label('Footer label'),
                                TextInput::make('footer_icon')->label('Footer icon'),
                            ])->columns(2)->defaultItems(0)->collapsible()->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Existence')->schema([
                        Section::make('Existence')->columns(2)->schema([
                            TextInput::make('existence.eyebrow')->label('Eyebrow'),
                            TextInput::make('existence.title')->label('Title')->columnSpanFull(),
                            Textarea::make('existence.highlight')->label('Highlight')->rows(2)->columnSpanFull(),
                            TextInput::make('existence.image_url')->label('Image URL')->columnSpanFull(),
                            TextInput::make('existence.image_alt')->label('Image alt')->columnSpanFull(),
                            Repeater::make('existence.paragraphs')->label('Paragraphs')->schema([
                                Textarea::make('text')->required()->rows(3)->label('Paragraph'),
                            ])->defaultItems(0)->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('CTA')->schema([
                        Section::make('Bottom CTA')->columns(2)->schema([
                            TextInput::make('cta.badge')->label('Badge'),
                            Textarea::make('cta.title_html')->label('Title HTML')->rows(2)->columnSpanFull(),
                            Textarea::make('cta.body')->label('Body')->rows(3)->columnSpanFull(),
                            TextInput::make('cta.cta_label')->label('CTA label'),
                            TextInput::make('cta.cta_url')->label('CTA URL'),
                            Repeater::make('cta.trust_items')->label('Trust items')->schema([
                                TextInput::make('text')->required()->label('Item'),
                            ])->defaultItems(0)->reorderable()->columnSpanFull(),
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

    public function save(): void
    {
        $this->saveCmsFormData($this->form->getState());

        Notification::make()
            ->success()
            ->title('About page content saved')
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
                            ->label('Save about content')
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }
}
