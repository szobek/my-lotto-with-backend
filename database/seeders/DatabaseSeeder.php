<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserRole;
use App\Models\WinnerNumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        Ticket::factory(22)->create();
        WinnerNumber::factory(3)->create();
        Balance::factory(10)->create();
        User::create([
            'name' => 'admin',
            'email' =>  'admin@admin',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Role::factory(20)->create();
        UserRole::factory(10)->create();
    }
}
