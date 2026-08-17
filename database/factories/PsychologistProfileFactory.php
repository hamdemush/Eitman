<?php

namespace Database\Factories;

use App\Models\PsychologistProfile;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PsychologistProfileFactory extends Factory
{
    protected $model = PsychologistProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->psychologist(),
            'specialty_id' => Specialty::factory(),
            'bio' => fake('ar_SA')->paragraph(),
            'experience_years' => fake()->numberBetween(2, 20),
            'cv_attachment' => 'cvs/sample_cv.pdf',
            'is_verified' => true,
        ];
    }
}