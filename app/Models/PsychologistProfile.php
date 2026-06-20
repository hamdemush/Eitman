<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychologistProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty_id',
        'bio',
        'experience_years',
        'cv_attachment',
        'is_verified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }
}