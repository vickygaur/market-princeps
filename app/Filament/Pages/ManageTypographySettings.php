<?php

namespace App\Filament\Pages;

use App\Support\Typography;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageTypographySettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLanguage;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Typography';

    protected static ?string $title = 'Typography Settings';

    protected static ?string $slug = 'typography-settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(Typography::get());
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Typography')->tabs([
                Tab::make('Font families')->schema([
                    Section::make('Site-wide fonts')
                        ->description('These fonts feed every content role unless a role overrides them. Changes apply across Home, About, Contact, Services, header, and footer.')
                        ->columns(2)
                        ->schema([
                            Select::make('heading_font')
                                ->label('Heading font')
                                ->options(Typography::fontOptions())
                                ->searchable()
                                ->required()
                                ->live()
                                ->helperText('Heroes, section titles, card titles.'),
                            Select::make('body_font')
                                ->label('Body font')
                                ->options(Typography::fontOptions())
                                ->searchable()
                                ->required()
                                ->live()
                                ->helperText('Paragraphs, forms, supporting copy.'),
                            Select::make('label_font')
                                ->label('Label font')
                                ->options(Typography::fontOptions())
                                ->searchable()
                                ->required()
                                ->live()
                                ->helperText('Eyebrows, badges, UI labels.'),
                            TextInput::make('base_line_height')
                                ->label('Base line height')
                                ->live(onBlur: true)
                                ->helperText('Fallback line-height for body text (e.g. 1.5).'),
                        ]),
                ]),
                Tab::make('Display & headings')->schema([
                    $this->roleSection('display_hero'),
                    $this->roleSection('display_hero_mobile'),
                    $this->roleSection('headline_lg'),
                    $this->roleSection('headline_lg_mobile'),
                    $this->roleSection('headline_md'),
                    $this->roleSection('headline_sm'),
                ]),
                Tab::make('Body text')->schema([
                    $this->roleSection('body_lg'),
                    $this->roleSection('body_md'),
                    $this->roleSection('body_sm'),
                    $this->roleSection('title_md'),
                ]),
                Tab::make('Labels & UI')->schema([
                    $this->roleSection('label_md'),
                    $this->roleSection('label_caps'),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    protected function roleSection(string $roleKey): Section
    {
        $meta = Typography::roleDefinitions()[$roleKey];
        $usedOn = Typography::rolePreviewMeta()[$roleKey]['used_on'] ?? [];

        return Section::make($meta['label'])
            ->description($meta['help'].(empty($usedOn) ? '' : ' Affects: '.implode(', ', $usedOn).'.'))
            ->columns(2)
            ->collapsed()
            ->schema([
                Select::make("roles.{$roleKey}.family")
                    ->label('Font group')
                    ->options([
                        'heading' => 'Heading font',
                        'body' => 'Body font',
                        'label' => 'Label font',
                    ])
                    ->required()
                    ->live(),
                Select::make("roles.{$roleKey}.custom_font")
                    ->label('Override font')
                    ->options(Typography::fontOptions())
                    ->searchable()
                    ->placeholder('Use font group')
                    ->helperText('Optional. Overrides the group font for this role only.')
                    ->live(),
                TextInput::make("roles.{$roleKey}.size")
                    ->label('Size')
                    ->placeholder('32px')
                    ->required()
                    ->live(onBlur: true),
                TextInput::make("roles.{$roleKey}.line_height")
                    ->label('Line height')
                    ->placeholder('40px')
                    ->required()
                    ->live(onBlur: true),
                Select::make("roles.{$roleKey}.weight")
                    ->label('Weight')
                    ->options(Typography::weightOptions())
                    ->required()
                    ->live(),
                TextInput::make("roles.{$roleKey}.letter_spacing")
                    ->label('Letter spacing')
                    ->placeholder('-0.02em')
                    ->live(onBlur: true),
            ]);
    }

    public function save(): void
    {
        Typography::save($this->form->getState());

        Notification::make()
            ->title('Typography saved')
            ->body('Frontend fonts and type scales will update on the next page load.')
            ->success()
            ->send();
    }

    public function resetToDefaults(): void
    {
        Typography::save(Typography::defaults());
        $this->form->fill(Typography::defaults());

        Notification::make()
            ->title('Typography reset')
            ->body('Restored the original Market Princeps type scale.')
            ->success()
            ->send();
    }

    public function content(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make([
                'default' => 1,
                'xl' => 12,
            ])->schema([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('save')
                    ->columnSpan([
                        'default' => 1,
                        'xl' => 7,
                    ])
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save typography')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                            Action::make('resetToDefaults')
                                ->label('Reset to defaults')
                                ->color('gray')
                                ->requiresConfirmation()
                                ->action('resetToDefaults'),
                        ]),
                    ]),
                View::make('filament.pages.partials.typography-preview')
                    ->viewData(fn (ManageTypographySettings $livewire): array => [
                        'config' => Typography::fromDraft($livewire->data ?? []),
                    ])
                    ->columnSpan([
                        'default' => 1,
                        'xl' => 5,
                    ]),
            ]),
        ]);
    }
}
