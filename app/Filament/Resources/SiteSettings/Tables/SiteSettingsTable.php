<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')->badge()->sortable(),
                TextColumn::make('label')->searchable(),
                TextColumn::make('key')->searchable()->copyable(),
                TextColumn::make('value')->limit(40),
                TextColumn::make('type')->badge(),
            ])
            ->defaultSort('group')
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
