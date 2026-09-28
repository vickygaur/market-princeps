<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('help_category')->options([
                'marketing' => 'Marketing & Demand',
                'technology' => 'Custom Technology',
                'optimization' => 'Business Optimization',
                'combination' => 'A combination of all',
                'need_help' => 'Not sure — need guidance',
            ]),
            TextInput::make('name')->required(),
            TextInput::make('email')->email()->required(),
            TextInput::make('phone')->tel(),
            TextInput::make('company'),
            Textarea::make('message')->rows(4),
            Select::make('status')->options([
                'new' => 'New',
                'contacted' => 'Contacted',
                'qualified' => 'Qualified',
                'closed' => 'Closed',
                'spam' => 'Spam',
            ])->default('new')->required(),
            TextInput::make('source')->default('homepage'),
        ]);
    }
}
