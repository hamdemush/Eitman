<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Specialty;
use App\Models\SmartAssessment;

class SmartAssessmentSeeder extends Seeder
{
    public function run(): void
    {
        $patients = User::where('role', 'patient')->take(5)->get();
        $specialties = Specialty::all();

        if ($patients->isEmpty() || $specialties->isEmpty()) {
            return;
        }

        foreach ($patients as $index => $patient) {
            SmartAssessment::create([
                'patient_id' => $patient->id,
                'anxiety_score' => rand(3, 8),
                'stress_score' => rand(4, 9),
                'depression_score' => rand(2, 6),
                'recommended_specialty_id' => $specialties->get($index % $specialties->count())->id,
            ]);
        }
    }
}