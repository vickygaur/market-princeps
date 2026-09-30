<?php

namespace App\Filament\Resources\NavigationItems\Schemas;

use App\Support\MaterialIcons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NavigationItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('location')->options([
                'header' => 'Header',
                'footer' => 'Footer',
            ])->default('header')->required(),
            Select::make('parent_id')
                ->label('Parent')
                ->relationship('parent', 'label')
                ->searchable()
                ->preload(),
            TextInput::make('label')->required(),
            TextInput::make('url'),
            Select::make('type')->options([
                'link' => 'Link',
                'dropdown' => 'Dropdown',
                'button' => 'Button',
            ])->default('link'),
            MaterialIcons::select('icon'),
            TextInput::make('badge_color'),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
            Toggle::make('open_in_new_tab')->default(false),
        ]);
    }
}
