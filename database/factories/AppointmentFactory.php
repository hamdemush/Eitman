<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Availability;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'patient_id' => User::factory()->patient(),
            'psychologist_id' => User::factory()->psychologist(),
            'availability_id' => Availability::factory(),
            'status' => fake()->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
            'session_type' => fake()->randomElement(['text', 'voice', 'video']),
        ];
    }
}