<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numbers' => rand(1,90).','.rand(1,90).','.rand(1,90).','.rand(1,90).','.rand(1,90),
            'user_id' => rand(1, 10), // Assuming you have 10 users in your database
            'status' => 'inactive', 
        ];
    }
}
