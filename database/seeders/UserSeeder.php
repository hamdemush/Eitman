<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@etmaan.com'],
            ['name' => 'مدير النظام', 'password' => Hash::make('password123'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'doctor@etmaan.com'],
            ['name' => 'د. أحمد علي', 'password' => Hash::make('password123'), 'role' => 'psychologist', 'status' => 'approved']
        );

        User::updateOrCreate(
            ['email' => 'patient@etmaan.com'],
            ['name' => 'طالب تجريبي', 'password' => Hash::make('password123'), 'role' => 'patient']
        );

    }
}