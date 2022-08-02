<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'device_id',
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function device()
    {
        return $this->belongsTo('App\Models\Device');
    }
}
