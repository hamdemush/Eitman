<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Complaint;

class ComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $patients = User::where('role', 'patient')->take(2)->get();

        Complaint::create([
            'user_id' => $patients[0]->id,
            'title' => 'مشكلة في الاتصال الصوتي',
            'description' => 'حدث انقطاع بسيط في الصوت خلال الدقائق الأخيرة من الجلسة.',
            'status' => 'resolved',
        ]);

        Complaint::create([
            'user_id' => $patients[1]->id,
            'title' => 'Inquiry regarding appointment rescheduling',
            'description' => 'I wanted to know if I can reschedule my appointment 24 hours prior.',
            'status' => 'pending',
        ]);
    }
}