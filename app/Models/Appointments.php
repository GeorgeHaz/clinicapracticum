<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointments extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'appointments';

    protected $fillable = [
        'id',
        'patients_id',
        'doctors_id',
        'specialties_id',
        'appointments_date',
        'start_time',
        'end_time',
        'status',
        'observations',
    ];

    protected $dates = [
        'appointments_date',
        'start_time',
        'end_time',
        'deleted_at'
    ];

    // Relación con Paciente
    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patients_id');
    }

    // Relación con Médico (Usuario)
    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctors_id');
    }

    // Relación con Especialidad
    public function specialty()
    {
        return $this->belongsTo(Specialties::class, 'specialties_id');
    }
}
