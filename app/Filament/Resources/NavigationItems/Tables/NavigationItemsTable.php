<?php

namespace App\Filament\Resources\NavigationItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NavigationItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('location')->badge(),
                TextColumn::make('label')->searchable(),
                TextColumn::make('url')->limit(30),
                TextColumn::make('parent.label')->label('Parent'),
                TextColumn::make('sort_order')->sortable(),
                IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
