<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPsychologist()
    {
        return $this->role === 'psychologist';
    }

    public function isPatient()
    {
        return $this->role === 'patient';
    }

    public function psychologistProfile()
    {
        return $this->hasOne(PsychologistProfile::class, 'user_id');
    }

    public function appointmentsAsPatient()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function appointmentsAsPsychologist()
    {
        return $this->hasMany(Appointment::class, 'psychologist_id');
    }

    public function smartAssessments()
    {
        return $this->hasMany(SmartAssessment::class, 'patient_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'user_id');
    }
}