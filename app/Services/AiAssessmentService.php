<?php

namespace App\Services;

class AiAssessmentService
{
    public function evaluateAssessment(array $data)
    {
        return [
            'anxiety_score' => $data['anxiety_score'] ?? 0,
            'stress_score' => $data['stress_score'] ?? 0,
            'depression_score' => $data['depression_score'] ?? 0,
        ];
    }
}