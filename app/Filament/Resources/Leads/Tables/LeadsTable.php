<?php

namespace App\Filament\Resources\Leads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->copyable(),
                TextColumn::make('company')->toggleable()->searchable(),
                TextColumn::make('phone')->toggleable(),
                TextColumn::make('help_category')->badge(),
                TextColumn::make('source')->badge()->toggleable(),
                TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'new' => 'warning',
                    'contacted' => 'info',
                    'qualified' => 'success',
                    'closed' => 'gray',
                    'spam' => 'danger',
                    default => 'gray',
                }),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    'new' => 'New',
                    'contacted' => 'Contacted',
                    'qualified' => 'Qualified',
                    'closed' => 'Closed',
                    'spam' => 'Spam',
                ]),
                SelectFilter::make('source'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
