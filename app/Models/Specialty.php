<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function psychologistProfiles()
    {
        return $this->hasMany(PsychologistProfile::class, 'specialty_id');
    }

    public function smartAssessments()
    {
        return $this->hasMany(SmartAssessment::class, 'recommended_specialty_id');
    }
}