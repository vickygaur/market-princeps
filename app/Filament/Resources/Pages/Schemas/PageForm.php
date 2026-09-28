<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Page')
                    ->tabs([
                        Tab::make('Content')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($state, callable $set, $get) {
                                        if (! $get('slug')) {
                                            $set('slug', str($state)->slug());
                                        }
                                    }),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                TextInput::make('template')
                                    ->default('home')
                                    ->required(),
                                Toggle::make('is_published')
                                    ->default(true),
                                DateTimePicker::make('published_at'),
                            ]),
                        Tab::make('SEO')
                            ->schema([
                                Section::make('Search Engine')
                                    ->schema([
                                        TextInput::make('meta_title')
                                            ->maxLength(70)
                                            ->helperText('Recommended: 50–60 characters'),
                                        Textarea::make('meta_description')
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->helperText('Recommended: 150–160 characters'),
                                        TextInput::make('meta_keywords')
                                            ->helperText('Comma-separated keywords'),
                                        TextInput::make('canonical_url')
                                            ->url()
                                            ->maxLength(255),
                                        TextInput::make('robots')
                                            ->default('index, follow')
                                            ->helperText('e.g. index, follow | noindex, nofollow'),
                                    ]),
                                Section::make('Open Graph / Social')
                                    ->schema([
                                        TextInput::make('og_title')->maxLength(255),
                                        Textarea::make('og_description')->rows(3),
                                        FileUpload::make('og_image')
                                            ->image()
                                            ->directory('seo')
                                            ->disk('public'),
                                    ]),
                                Section::make('Structured Data')
                                    ->schema([
                                        Textarea::make('schema_markup')
                                            ->rows(8)
                                            ->helperText('Paste JSON-LD schema markup (without script tags)'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
