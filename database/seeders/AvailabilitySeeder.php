<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Availability;

class AvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        $psychologists = User::where('role', 'psychologist')->get();

        foreach ($psychologists as $psychologist) {
            for ($i = 1; $i <= 5; $i++) {
                Availability::create([
                    'psychologist_id' => $psychologist->id,
                    'available_date' => now()->addDays($i)->format('Y-m-d'),
                    'start_time' => '10:00:00',
                    'end_time' => '11:00:00',
                    'is_booked' => true,
                ]);

                Availability::create([
                    'psychologist_id' => $psychologist->id,
                    'available_date' => now()->addDays($i)->format('Y-m-d'),
                    'start_time' => '14:00:00',
                    'end_time' => '15:00:00',
                    'is_booked' => false,
                ]);
            }
        }
    }
}