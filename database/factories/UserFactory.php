<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    
    public function definition(): array
    {
        return [
            'name' => fake('ar_SA')->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // كلمة السر هي: password
            'role' => 'patient',
            'status' => 'active',
            'remember_token' => Str::random(10),
        ];
    }

    public function patient(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'patient',
        ]);
    }

    public function psychologist(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'psychologist',
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
            'role' => 'patient',

        ]);
    }

    }