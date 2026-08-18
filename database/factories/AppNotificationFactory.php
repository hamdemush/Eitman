<?php

namespace Database\Factories;

use App\Models\AppNotification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppNotificationFactory extends Factory
{
    protected $model = AppNotification::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake('ar_SA')->sentence(3),
            'body' => fake('ar_SA')->paragraph(),
            'is_read' => fake()->boolean(30),
        ];
    }
}