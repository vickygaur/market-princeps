<?php

namespace App\Filament\Resources\Services\Pages;

use App\Filament\Resources\Services\ServiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $primary = data_get($data, 'page_content.hero.primary_cta');

        if (filled($primary)) {
            data_set($data, 'page_content.cta.primary_label', $primary);
        }

        return $data;
    }
}
