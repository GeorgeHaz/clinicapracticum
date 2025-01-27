<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Histories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'histories';

    protected $fillable = [
        'id',
        'patient_id',
        'doctor_id',
        'entry_date',
        'description',
    ];

    protected $dates = ['entry_date'];

    // Relación con el Paciente
    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }

    // Relación con el Usuario (Médico)
    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor_id');
    }
}
