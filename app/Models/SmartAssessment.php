<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmartAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'anxiety_score',
        'stress_score',
        'depression_score',
        'recommended_specialty_id'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function recommendedSpecialty()
    {
        return $this->belongsTo(Specialty::class, 'recommended_specialty_id');
    }
}