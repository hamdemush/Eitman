<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'psychologist_id',
        'availability_id',
        'status',
        'session_type'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id');
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class, 'availability_id');
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class, 'appointment_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'appointment_id');
    }
}