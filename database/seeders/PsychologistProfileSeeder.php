<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Specialty;
use App\Models\PsychologistProfile;

class PsychologistProfileSeeder extends Seeder
{
    public function run(): void
    {
        $psychologists = User::where('role', 'psychologist')->get();
        $specialties = Specialty::all();

        $bios = [
            'استشاري الطب النفسي مع خبرة تزيد عن 10 سنوات في العلاج السلوكي والاستشارات النفسية.',
            'Licensed Psychologist specializing in Cognitive Behavioral Therapy with extensive international experience.',
            'أخصائية نفسية متخصصة في علاج القلق والتوتر والاستشارات الأسرية والعلاقات.',
            'Clinical Psychologist focusing on adult mental health, stress management, and emotional well-being.'
        ];

        foreach ($psychologists as $index => $psychologist) {
            PsychologistProfile::create([
                'user_id' => $psychologist->id,
                'specialty_id' => $specialties->get($index % $specialties->count())->id,
                'bio' => $bios[$index % count($bios)],
                'experience_years' => rand(5, 15),
                'cv_attachment' => 'cvs/psychologist_' . $psychologist->id . '.pdf',
                'is_verified' => true,
            ]);
        }
    }
}