<?php

namespace App\Filament\Resources\NewsletterSubscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NewsletterSubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
            Toggle::make('is_active')->default(true),
            DateTimePicker::make('subscribed_at'),
        ]);
    }
}
