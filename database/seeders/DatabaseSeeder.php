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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
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