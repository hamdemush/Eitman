<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $appointment = Appointment::first();

        if ($appointment) {
            Message::create([
                'appointment_id' => $appointment->id,
                'sender_id' => $appointment->patient_id,
                'message' => 'السلام عليكم دكتور، هل يمكنني الاستفسار عن موعد الجلسة القادمة؟',
                'file_path' => null,
                'is_read' => true,
            ]);

            Message::create([
                'appointment_id' => $appointment->id,
                'sender_id' => $appointment->psychologist_id,
                'message' => 'وعليكم السلام ورحمة الله، أهلاً بك. نعم الموعد مؤكد غداً الساعة 10 صباحاً.',
                'file_path' => null,
                'is_read' => true,
            ]);
        }
    }
}