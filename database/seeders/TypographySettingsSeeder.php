<?php

namespace Database\Seeders;

use App\Support\Typography;
use Illuminate\Database\Seeder;

class TypographySettingsSeeder extends Seeder
{
    public function run(): void
    {
        Typography::save(Typography::defaults());
    }
}
