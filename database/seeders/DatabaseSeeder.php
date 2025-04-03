<?php

namespace Database\Seeders;

use App\Models\WinnerNumber;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        WinnerNumber::factory(3)->create();
    }
}
