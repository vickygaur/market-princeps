<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
class ManageSiteSettings extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Site Settings';

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'site_name' => SiteSetting::getValue('site_name', 'Market Princeps'),
            'site_tagline' => SiteSetting::getValue('site_tagline', SiteSetting::getValue('brand_tagline', 'Growth Architecture')),
            'site_description' => SiteSetting::getValue('site_description', 'We help businesses attract the right customers, build the technology they need, and improve the way their business works.'),
            'site_logo' => SiteSetting::getValue('site_logo'),
            'site_favicon' => SiteSetting::getValue('site_favicon'),
            'contact_email' => SiteSetting::getValue('contact_email', 'connect@marketprinceps.com'),
            'contact_phone' => SiteSetting::getValue('contact_phone', '+91-9625330200'),
            'contact_phone_href' => SiteSetting::getValue('contact_phone_href', '+919625330200'),
            'footer_badge' => SiteSetting::getValue('footer_badge', 'BUILT AROUND YOUR BUSINESS'),
            'copyright_text' => SiteSetting::getValue('copyright_text', '© '.date('Y').' Market Princeps Pvt. Ltd. All rights reserved.'),
            'default_meta_title' => SiteSetting::getValue('default_meta_title', SiteSetting::getValue('meta_title', 'Market Princeps | Marketing, Technology & Business Growth')),
            'default_meta_description' => SiteSetting::getValue('default_meta_description', SiteSetting::getValue('meta_description', 'Market Princeps brings marketing, technology, and business systems together to turn attention into customers and ideas into scalable growth.')),
            'default_meta_keywords' => SiteSetting::getValue('default_meta_keywords', SiteSetting::getValue('meta_keywords', 'marketing, technology, business growth, SEO, custom software, digital transformation')),
            'default_og_image' => SiteSetting::getValue('default_og_image', SiteSetting::getValue('og_image')),
            'default_robots' => SiteSetting::getValue('default_robots', SiteSetting::getValue('robots', 'index, follow')),
            'google_analytics_id' => SiteSetting::getValue('google_analytics_id'),
            'google_tag_manager_id' => SiteSetting::getValue('google_tag_manager_id'),
            'facebook_url' => SiteSetting::getValue('facebook_url'),
            'instagram_url' => SiteSetting::getValue('instagram_url'),
            'linkedin_url' => SiteSetting::getValue('linkedin_url'),
            'twitter_url' => SiteSetting::getValue('twitter_url'),
            'privacy_policy_url' => SiteSetting::getValue('privacy_policy_url', '#'),
            'terms_url' => SiteSetting::getValue('terms_url', '#'),
        ]);
    }

    public function defaultForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('data');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')->tabs([
                    Tab::make('Brand')->schema([
                        Section::make('Brand identity')->columns(2)->schema([
                            TextInput::make('site_name')->required(),
                            TextInput::make('site_tagline'),
                            Textarea::make('site_description')->rows(3)->columnSpanFull(),
                            FileUpload::make('site_logo')
                                ->label('Site logo')
                                ->image()
                                ->directory('brand')
                                ->disk('public')
                                ->visibility('public')
                                ->maxFiles(1)
                                ->maxSize(2048)
                                ->imagePreviewHeight('120')
                                ->panelLayout('compact')
                                ->uploadingMessage('Uploading logo…')
                                ->removeUploadedFileButtonPosition('right')
                                ->helperText('Header & footer logo. Max 2MB. PNG/JPG/WebP/SVG recommended.'),
                            FileUpload::make('site_favicon')
                                ->label('Favicon')
                                ->image()
                                ->directory('brand')
                                ->disk('public')
                                ->visibility('public')
                                ->maxFiles(1)
                                ->maxSize(512)
                                ->imagePreviewHeight('80')
                                ->panelLayout('compact')
                                ->uploadingMessage('Uploading favicon…')
                                ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/vnd.microsoft.icon', 'image/svg+xml', 'image/webp', 'image/jpeg'])
                                ->helperText('Browser tab icon. Square image, max 512KB.'),
                            TextInput::make('footer_badge'),
                            TextInput::make('copyright_text')->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('Contact')->schema([
                        TextInput::make('contact_email')->email()->required(),
                        TextInput::make('contact_phone')->required(),
                        TextInput::make('contact_phone_href')->helperText('Digits only for tel: link'),
                    ]),
                    Tab::make('Global SEO')->schema([
                        Section::make('Defaults used when a page has no SEO values')->schema([
                            TextInput::make('default_meta_title')->maxLength(70),
                            Textarea::make('default_meta_description')->rows(3)->maxLength(160),
                            TextInput::make('default_meta_keywords'),
                            FileUpload::make('default_og_image')
                                ->image()
                                ->directory('seo')
                                ->disk('public')
                                ->visibility('public')
                                ->maxFiles(1)
                                ->maxSize(2048)
                                ->imagePreviewHeight('120')
                                ->panelLayout('compact'),
                            TextInput::make('default_robots')->default('index, follow'),
                            TextInput::make('google_analytics_id')->label('Google Analytics ID'),
                            TextInput::make('google_tag_manager_id')->label('Google Tag Manager ID'),
                        ]),
                    ]),
                    Tab::make('Social & Legal')->schema([
                        TextInput::make('facebook_url')->url(),
                        TextInput::make('instagram_url')->url(),
                        TextInput::make('linkedin_url')->url(),
                        TextInput::make('twitter_url')->url(),
                        TextInput::make('privacy_policy_url'),
                        TextInput::make('terms_url'),
                    ]),
                ])->columnSpanFull(),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $map = [
            'site_name' => ['brand', 'text', 'Site Name'],
            'site_tagline' => ['brand', 'text', 'Tagline'],
            'site_description' => ['brand', 'textarea', 'Site Description'],
            'site_logo' => ['brand', 'image', 'Site Logo'],
            'site_favicon' => ['brand', 'image', 'Favicon'],
            'footer_badge' => ['footer', 'text', 'Footer Badge'],
            'copyright_text' => ['footer', 'text', 'Copyright'],
            'contact_email' => ['contact', 'text', 'Email'],
            'contact_phone' => ['contact', 'text', 'Phone'],
            'contact_phone_href' => ['contact', 'text', 'Phone Href'],
            'default_meta_title' => ['seo', 'text', 'Default Meta Title'],
            'default_meta_description' => ['seo', 'textarea', 'Default Meta Description'],
            'default_meta_keywords' => ['seo', 'text', 'Default Meta Keywords'],
            'default_og_image' => ['seo', 'image', 'Default OG Image'],
            'default_robots' => ['seo', 'text', 'Default Robots'],
            'google_analytics_id' => ['seo', 'text', 'Google Analytics ID'],
            'google_tag_manager_id' => ['seo', 'text', 'GTM ID'],
            'facebook_url' => ['social', 'url', 'Facebook'],
            'instagram_url' => ['social', 'url', 'Instagram'],
            'linkedin_url' => ['social', 'url', 'LinkedIn'],
            'twitter_url' => ['social', 'url', 'Twitter / X'],
            'privacy_policy_url' => ['footer', 'url', 'Privacy Policy URL'],
            'terms_url' => ['footer', 'url', 'Terms URL'],
        ];

        foreach ($map as $key => [$group, $type, $label]) {
            $value = $data[$key] ?? null;

            if ($type === 'image') {
                $value = normalize_upload_path($value);
            } elseif (is_array($value)) {
                $value = normalize_upload_path($value) ?? (array_values($value)[0] ?? null);
            }

            SiteSetting::setValue($key, $value, $group, $type, $label);
        }

        // Keep legacy keys in sync for the frontend layout
        SiteSetting::setValue('brand_name', $data['site_name'] ?? null, 'brand', 'text', 'Brand Name');
        SiteSetting::setValue('meta_title', $data['default_meta_title'] ?? null, 'seo', 'text', 'Meta Title');
        SiteSetting::setValue('meta_description', $data['default_meta_description'] ?? null, 'seo', 'textarea', 'Meta Description');
        SiteSetting::setValue('meta_keywords', $data['default_meta_keywords'] ?? null, 'seo', 'text', 'Meta Keywords');
        SiteSetting::setValue('brand_tagline', $data['site_tagline'] ?? null, 'brand', 'text', 'Brand Tagline');
        SiteSetting::setValue('og_image', normalize_upload_path($data['default_og_image'] ?? null), 'seo', 'image', 'OG Image');

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([EmbeddedSchema::make('form')])
                    ->id('form')
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ]);
    }
}
