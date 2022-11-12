<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDeviceReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_device_id',
        'temperature',
        'heart_rate',
        'diastolic',
        'systolic',
        'oxygen_saturation',
        'respiratory_rate',
        'latitude',
        'longitude'
    ];
}
