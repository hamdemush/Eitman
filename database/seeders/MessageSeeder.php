<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $patient = User::where('role', 'patient')->first();
        $psychologist = User::where('role', 'psychologist')->first();

        if ($patient && $psychologist) {
            Message::create([
                'sender_id' => $patient->id,
                'receiver_id' => $psychologist->id,
                'message_text' => 'السلام عليكم دكتور، هل يمكنني الاستفسار عن موعد الجلسة القادمة؟',
            ]);

            Message::create([
                'sender_id' => $psychologist->id,
                'receiver_id' => $patient->id,
                'message_text' => 'وعليكم السلام ورحمة الله، أهلاً بك. نعم الموعد مؤكد غداً الساعة 10 صباحاً.',
            ]);
        }
    }
}