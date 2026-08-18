<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $appointments = Appointment::where('status', 'completed')->take(7)->get();

        $reviewsData = [
            ['rating' => 5, 'comment' => 'جلسة ممتازة جداً واستفدت منها كثيراً، شكراً دكتور على حسن الاستماع والصبر.'],
            ['rating' => 5, 'comment' => 'Great experience! Very empathetic and helpful therapist. Highly recommended.'],
            ['rating' => 4, 'comment' => 'الدكتور مستمع ممتاز وقدم لي نصائح عملية رائعة ساعدتني في التعامل مع القلق.'],
            ['rating' => 5, 'comment' => 'Highly recommended! Professional service, punctual, and very helpful insights.'],
            ['rating' => 5, 'comment' => 'تجربة طيبة ومريحة للغاية، وسأقوم بحجز جلسة متابعة قريباً إن شاء الله.'],
            ['rating' => 4, 'comment' => 'The session was very insightful and made me feel much better about my progress.'],
            ['rating' => 5, 'comment' => 'تعامل راقي جداً وأسلوب مريح وطرح حلول منطقية وواقعية.'],
        ];

        foreach ($appointments as $index => $appointment) {
            Review::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient_id,
                'psychologist_id' => $appointment->psychologist_id,
                'rating' => $reviewsData[$index]['rating'],
                'comment' => $reviewsData[$index]['comment'],
            ]);
        }
    }
}