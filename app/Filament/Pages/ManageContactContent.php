<?php

namespace App\Filament\Pages;

use App\Filament\Concerns\ManagesCmsPage;
use App\Support\MaterialIcons;
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
class ManageContactContent extends Page
{
    use ManagesCmsPage;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static string|UnitEnum|null $navigationGroup = 'Contact Page';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Contact Content';

    protected static ?string $title = 'Contact Page Content';

    protected static ?string $slug = 'contact-content';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    protected static function pageSlug(): string
    {
        return 'contact';
    }

    protected static function sectionKeys(): array
    {
        return ['hero', 'hub', 'faq'];
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

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Contact')
                ->persistTabInQueryString()
                ->columnSpanFull()
                ->tabs([
                    Tab::make('Hero')->schema([
                        Section::make('Hero')->columns(2)->schema([
                            TextInput::make('hero.badge')->label('Badge'),
                            TextInput::make('hero.title_prefix')->label('Title prefix'),
                            TextInput::make('hero.title_shimmer')->label('Highlighted title')->columnSpanFull(),
                            Textarea::make('hero.body')->label('Body')->rows(3)->columnSpanFull(),
                            Repeater::make('hero.trust_markers')->label('Trust markers')->schema([
                                MaterialIcons::select('icon'),
                                TextInput::make('label')->required(),
                            ])->columns(2)->defaultItems(0)->reorderable()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Hub')->schema([
                        Section::make('Email card')->columns(2)->schema([
                            TextInput::make('hub.email.label')->label('Label'),
                            TextInput::make('hub.email.address')->label('Email address')->email(),
                            Textarea::make('hub.email.body')->label('Body')->rows(2)->columnSpanFull(),
                        ]),
                        Section::make('Call card')->columns(2)->schema([
                            TextInput::make('hub.call.label')->label('Label'),
                            TextInput::make('hub.call.phone')->label('Phone'),
                            TextInput::make('hub.call.phone_href')->label('Phone href'),
                            TextInput::make('hub.call.call_label')->label('Call button'),
                            TextInput::make('hub.call.whatsapp_label')->label('WhatsApp button'),
                            TextInput::make('hub.call.whatsapp_url')->label('WhatsApp URL'),
                            TextInput::make('hub.call.hours')->label('Hours')->columnSpanFull(),
                            Textarea::make('hub.call.body')->label('Body')->rows(2)->columnSpanFull(),
                        ]),
                        Section::make('Form')->columns(2)->schema([
                            TextInput::make('hub.form.eyebrow')->label('Eyebrow'),
                            TextInput::make('hub.form.title')->label('Title')->columnSpanFull(),
                            Textarea::make('hub.form.intro')->label('Intro')->rows(2)->columnSpanFull(),
                            TextInput::make('hub.form.category_label')->label('Category label'),
                            TextInput::make('hub.form.submit_label')->label('Submit label'),
                            TextInput::make('hub.form.success_title')->label('Success title')->columnSpanFull(),
                            Textarea::make('hub.form.success_body')->label('Success body')->rows(2)->columnSpanFull(),
                            Repeater::make('hub.form.categories')->label('Help categories')->schema([
                                TextInput::make('label')->required(),
                                TextInput::make('value')->required(),
                            ])->columns(2)->defaultItems(0)->reorderable()->columnSpanFull(),
                            Repeater::make('hub.form.trust_badges')->label('Trust badges')->schema([
                                MaterialIcons::select('icon'),
                                TextInput::make('label')->required(),
                            ])->columns(2)->defaultItems(0)->columnSpanFull(),
                        ]),
                        Section::make('Protocol')->columns(2)->schema([
                            TextInput::make('hub.protocol.title')->label('Title')->columnSpanFull(),
                            Repeater::make('hub.protocol.steps')->label('Steps')->schema([
                                TextInput::make('num')->label('Number'),
                                TextInput::make('title')->required(),
                                Textarea::make('body')->rows(2)->columnSpanFull(),
                            ])->columns(2)->defaultItems(0)->collapsible()->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('FAQ')->schema([
                        Section::make('FAQ')->columns(2)->schema([
                            TextInput::make('faq.eyebrow')->label('Eyebrow'),
                            TextInput::make('faq.title')->label('Title')->columnSpanFull(),
                            Repeater::make('faq.items')->label('Questions')->schema([
                                TextInput::make('question')->required()->columnSpanFull(),
                                Textarea::make('answer')->required()->rows(4)->columnSpanFull(),
                                Toggle::make('open')->label('Open by default')->default(false),
                            ])->defaultItems(0)->collapsible()->reorderable()
                                ->itemLabel(fn (array $state): ?string => $state['question'] ?? null)
                                ->columnSpanFull(),
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
            ->title('Contact page content saved')
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
                            ->label('Save contact content')
                            ->submit('save')
                            ->keyBindings(['mod+s']),
                    ]),
                ]),
        ]);
    }
}
