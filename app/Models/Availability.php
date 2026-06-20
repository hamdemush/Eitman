<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychologist_id',
        'available_date',
        'start_time',
        'end_time',
        'is_booked'
    ];

    public function psychologist()
    {
        return $this->belongsTo(User::class, 'psychologist_id');
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'availability_id');
    }
}