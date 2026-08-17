<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    protected $model = MedicalRecord::class;

    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'patient_id' => fn (array $attributes) => Appointment::find($attributes['appointment_id'])->patient_id ?? User::factory()->patient(),
            'psychologist_id' => fn (array $attributes) => Appointment::find($attributes['appointment_id'])->psychologist_id ?? User::factory()->psychologist(),
            'session_notes' => fake('ar_SA')->paragraph(),
            'treatment_plan' => fake('ar_SA')->sentence(),
        ];
    }
}