<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\User;
use App\Models\WinnerNumber;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        WinnerNumber::factory(3)->create();
        Balance::factory(10)->create();
    }
}
