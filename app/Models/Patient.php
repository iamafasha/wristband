<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function devices()
    {
        return $this->hasManyThrough(Device::class, PatientDevice::class, 'patient_id', 'id', 'id', 'device_id');
    }

    public function doctors(){
        return $this->hasManyThrough(Doctor::class, PatientDoctor::class, 'patient_id', 'id', 'id', 'doctor_id');
    }

    public function contactPersons(){
        // has a user through patient contact person table with user_id as patient_id
        return $this->hasManyThrough(User::class, PatientContactPerson::class, 'patient_id', 'id', 'id', 'user_id');
    }

    public function patient_contact_people()
    {
        return $this->hasMany(PatientContactPerson::class);
    }

}
