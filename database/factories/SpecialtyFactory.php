<?php

namespace Database\Factories;

use App\Models\Specialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyFactory extends Factory
{
    protected $model = Specialty::class;

    public function definition(): array
    {
        return [
            'name' => fake('ar_SA')->randomElement([
                'العلاج المعرفي السلوكي',
                'الإرشاد الأسري والتطوير الذاتي',
                'علاج القلق والاكتئاب',
                'Cognitive Behavioral Therapy (CBT)',
                'Child & Adolescent Psychology',
                'Stress & Burnout Management'
            ]),
            'description' => fake('ar_SA')->sentence(),
        ];
    }
}