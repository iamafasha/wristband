<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac_address'
    ];

    //has a PatientDevice
    public function patientDevices()
    {
        return $this->hasMany(PatientDevice::class);
    }

    public function patients()
    {
        return $this->hasManyThrough(Patient::class, PatientDevice::class, 'device_id', 'id', 'id', 'patient_id');
    }
}
