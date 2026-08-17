<?php

namespace Database\Factories;

use App\Models\SmartAssessment;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SmartAssessmentFactory extends Factory
{
    protected $model = SmartAssessment::class;

    public function definition(): array
    {
        return [
            'patient_id' => User::factory()->patient(),
            'anxiety_score' => fake()->numberBetween(1, 10),
            'stress_score' => fake()->numberBetween(1, 10),
            'depression_score' => fake()->numberBetween(1, 10),
            'recommended_specialty_id' => Specialty::factory(),
        ];
    }
}