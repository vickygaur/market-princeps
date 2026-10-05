<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('group')->options([
                'general' => 'General',
                'brand' => 'Brand',
                'contact' => 'Contact',
                'seo' => 'Global SEO',
                'social' => 'Social',
                'footer' => 'Footer',
                'typography' => 'Typography',
            ])->default('general')->required(),
            TextInput::make('key')->required()->unique(ignoreRecord: true),
            TextInput::make('label'),
            Select::make('type')->options([
                'text' => 'Text',
                'textarea' => 'Textarea',
                'image' => 'Image',
                'url' => 'URL',
                'boolean' => 'Boolean',
                'json' => 'JSON',
            ])->default('text'),
            Textarea::make('value')->rows(4),
        ]);
    }
}
