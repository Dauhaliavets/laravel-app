<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApiKey::updateOrCreate(
            ['key' => 'valid-key'],
            ['name' => 'Test Client', 'is_active' => true],
        );

        ApiKey::updateOrCreate(
            ['key' => 'disabled-key'],
            ['name' => 'Disabled Client', 'is_active' => false],
        );
    }
}
