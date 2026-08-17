<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Availability;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $patients = User::where('role', 'patient')->get();
        $psychologists = User::where('role', 'psychologist')->get();
        $sessionTypes = ['text', 'voice', 'video'];

        for ($i = 0; $i < 7; $i++) {
            $patient = $patients[$i % $patients->count()];
            $psychologist = $psychologists[$i % $psychologists->count()];
            
            $availability = Availability::where('psychologist_id', $psychologist->id)
                ->where('is_booked', true)
                ->skip(floor($i / $psychologists->count()))
                ->first() ?? Availability::factory()->create(['psychologist_id' => $psychologist->id, 'is_booked' => true]);

            Appointment::create([
                'patient_id' => $patient->id,
                'psychologist_id' => $psychologist->id,
                'availability_id' => $availability->id,
                'status' => 'completed',
                'session_type' => $sessionTypes[$i % count($sessionTypes)],
            ]);
        }
    }
}