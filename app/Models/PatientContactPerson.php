<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientContactPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
    ];
}
