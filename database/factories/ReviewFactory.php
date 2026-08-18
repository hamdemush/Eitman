<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $bilingualComments = [
            'جلسة ممتازة جداً واستفدت منها كثيراً، شكراً دكتور.',
            'Great experience! Very empathetic and helpful therapist.',
            'الدكتور مستمع ممتاز وقدم لي نصائح عملية رائعة.',
            'Highly recommended! Professional service and great communication.',
            'تجربة طيبة وسأقوم بحجز جلسة أخرى قريباً.',
            'The session was insightful and made me feel much better.',
            'تعامل راقي جداً وأسلوب مريح في الحوار.'
        ];

        return [
            'appointment_id' => Appointment::factory(),
            'patient_id' => function (array $attributes) {
                return Appointment::find($attributes['appointment_id'])?->patient_id ?? User::factory()->patient();
            },
            'psychologist_id' => function (array $attributes) {
                return Appointment::find($attributes['appointment_id'])?->psychologist_id ?? User::factory()->psychologist();
            },
            'rating' => fake()->numberBetween(4, 5),
            'comment' => fake()->randomElement($bilingualComments),
        ];
    }
}