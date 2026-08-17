<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $doctors = [
            ['name' => 'د. أحمد محمود', 'email' => 'dr.ahmed@example.com'],
            ['name' => 'Dr. Sarah Connor', 'email' => 'dr.sarah@example.com'],
            ['name' => 'د. سارة العتيبي', 'email' => 'dr.sara.a@example.com'],
            ['name' => 'Dr. Michael Scott', 'email' => 'dr.michael@example.com'],
        ];

        foreach ($doctors as $doc) {
            User::create([
                'name' => $doc['name'],
                'email' => $doc['email'],
                'password' => Hash::make('password123'),
                'role' => 'psychologist',
                'status' => 'active',
                'email_verified_at' => now(),
            ]);
        }

        $patients = [
            ['name' => 'محمد علي', 'email' => 'patient1@example.com'],
            ['name' => 'John Doe', 'email' => 'patient2@example.com'],
            ['name' => 'فاطمة الزهراء', 'email' => 'patient3@example.com'],
            ['name' => 'Emily Watson', 'email' => 'patient4@example.com'],
            ['name' => 'خالد عبدالرحمن', 'email' => 'patient5@example.com'],
            ['name' => 'Alex Smith', 'email' => 'patient6@example.com'],
            ['name' => 'مريم يوسف', 'email' => 'patient7@example.com'],
            ['name' => 'David Miller', 'email' => 'patient8@example.com'],
            ['name' => 'عمر الفاروق', 'email' => 'patient9@example.com'],
            ['name' => 'Sophia Taylor', 'email' => 'patient10@example.com'],
        ];

        foreach ($patients as $pat) {
            User::create([
                'name' => $pat['name'],
                'email' => $pat['email'],
                'password' => Hash::make('password123'),
                'role' => 'patient',
                'status' => 'active',
                'email_verified_at' => now(),
            ]);
        }
    }
}