<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slug')
                    ->url(fn ($record) => route('services.show', $record->slug))
                    ->openUrlInNewTab()
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('category.name')->label('Category')->sortable(),
                TextColumn::make('sort_order')->sortable(),
                IconColumn::make('is_active')->boolean(),
                IconColumn::make('show_in_nav')->boolean()->label('Nav'),
                IconColumn::make('show_in_footer')->boolean()->label('Footer'),
                IconColumn::make('page_content')
                    ->label('Page')
                    ->boolean()
                    ->getStateUsing(fn ($record) => ! empty($record->page_content)),
            ])
            ->defaultSort('sort_order')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
