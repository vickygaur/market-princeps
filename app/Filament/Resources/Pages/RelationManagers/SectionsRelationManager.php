<?php

namespace App\Filament\Resources\Pages\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $title = 'Page Sections';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->helperText('e.g. hero, metrics, philosophy, triad, simulator, process, intake')
                    ->maxLength(100),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->default(true),
                Textarea::make('content')
                    ->label('Content (JSON)')
                    ->rows(20)
                    ->required()
                    ->helperText('Nested JSON for this section. Invalid JSON will not save.')
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('key')->badge()->searchable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('sort_order')->sortable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
