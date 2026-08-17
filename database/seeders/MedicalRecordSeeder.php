<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\MedicalRecord;

class MedicalRecordSeeder extends Seeder
{
    public function run(): void
    {
        $appointments = Appointment::where('status', 'completed')->get();

        foreach ($appointments as $appointment) {
            MedicalRecord::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $appointment->patient_id,
                'psychologist_id' => $appointment->psychologist_id,
                'session_notes' => 'المريض يعاني من بعض التوتر وقلق الامتحان. تم التناقش في آليات تنظيم الوقت والاسترخاء.',
                'treatment_plan' => 'ممارسة تمارين التنفس يومياً لمدة 10 دقائق ومتابعة التطور في الجلسة القادمة.',
            ]);
        }
    }
}