<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('page_id')
                ->relationship('page', 'title')
                ->required()
                ->searchable()
                ->preload(),
            TextInput::make('key')->required()->maxLength(100),
            TextInput::make('name')->required()->maxLength(255),
            TextInput::make('sort_order')->numeric()->default(0),
            Toggle::make('is_active')->default(true),
            Textarea::make('content')
                ->label('Content (JSON)')
                ->rows(20)
                ->formatStateUsing(fn ($state) => is_array($state)
                    ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                    : ($state ?: '{}'))
                ->dehydrateStateUsing(function ($state) {
                    $decoded = json_decode($state ?: '{}', true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        throw new \InvalidArgumentException('Invalid JSON: '.json_last_error_msg());
                    }

                    return $decoded;
                })
                ->columnSpanFull(),
        ]);
    }
}
