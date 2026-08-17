<?php

namespace Database\Factories;

use App\Models\Availability;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AvailabilityFactory extends Factory
{
    protected $model = Availability::class;

    public function definition(): array
    {
        return [
            'psychologist_id' => User::factory()->psychologist(),
            'available_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'start_time' => '10:00:00',
            'end_time' => '11:00:00',
            'is_booked' => false,
        ];
    }
}