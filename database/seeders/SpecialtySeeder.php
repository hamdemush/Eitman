<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'العلاج المعرفي السلوكي (CBT)',
                'description' => 'التركيز على تعديل الأفكار والأنماط السلوكية السلبية لتحسين الصحة النفسية.'
            ],
            [
                'name' => 'الاستشارات الأسرية والتربوية',
                'description' => 'تقديم الدعم للأسر والأزواج لحل النزاعات وتحسين جودة العلاقات.'
            ],
            [
                'name' => 'Depression & Anxiety Management',
                'description' => 'Specialized therapeutic techniques to deal with clinical anxiety, panic attacks, and depression.'
            ],
            [
                'name' => 'علاج الضغوط النفسية والاحتراق الوظيفي',
                'description' => 'مساعدة الأفراد في التعامل مع التوتر وضغوط العمل واستعادة التوازن.'
            ],
        ];

        foreach ($specialties as $spec) {
            Specialty::create($spec);
        }
    }
}