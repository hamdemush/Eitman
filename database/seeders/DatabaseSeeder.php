<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SpecialtySeeder::class,
            UserSeeder::class,
            PsychologistProfileSeeder::class,
            AvailabilitySeeder::class,
            AppointmentSeeder::class,
            ReviewSeeder::class,
            MedicalRecordSeeder::class,
            SmartAssessmentSeeder::class,
            ComplaintSeeder::class,
            MessageSeeder::class,
        ]);
    }
}