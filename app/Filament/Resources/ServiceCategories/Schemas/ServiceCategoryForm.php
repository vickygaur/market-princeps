<?php

namespace App\Filament\Resources\ServiceCategories\Schemas;

use App\Support\MaterialIcons;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ServiceCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Category')->tabs([
                Tab::make('Details')->schema([
                    TextInput::make('name')->required()->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set, $get) => $get('slug') ?: $set('slug', str($state)->slug())),
                    TextInput::make('slug')->required()->unique(ignoreRecord: true),
                    TextInput::make('badge_label'),
                    TextInput::make('badge_color')->helperText('e.g. secondary, primary, tertiary'),
                    MaterialIcons::select('icon'),
                    Textarea::make('description')->rows(3),
                    TextInput::make('sort_order')->numeric()->default(0),
                    Toggle::make('is_active')->default(true),
                    Toggle::make('show_in_nav')->default(true),
                    Toggle::make('show_in_footer')->default(true),
                ]),
                Tab::make('SEO')->schema([
                    Section::make()->schema([
                        TextInput::make('meta_title')->maxLength(70),
                        Textarea::make('meta_description')->rows(3)->maxLength(160),
                        TextInput::make('meta_keywords'),
                        TextInput::make('og_title'),
                        Textarea::make('og_description')->rows(2),
                        FileUpload::make('og_image')->image()->directory('seo')->disk('public'),
                        TextInput::make('canonical_url')->url(),
                        TextInput::make('robots')->default('index, follow'),
                    ]),
                ]),
            ])->columnSpanFull(),
        ]);
    }
}
