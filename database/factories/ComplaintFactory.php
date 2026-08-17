<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake('ar_SA')->sentence(4),
            'description' => fake('ar_SA')->paragraph(),
            'status' => fake()->randomElement(['pending', 'resolved']),
        ];
    }
}