<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'last_name',
        'dni',
        'birthdate',
        'gender',
        'address',
        'phone',
        'email',
        'blood_group',
        'allergies',
        'diseases',
        'emergency_contact_name',
        'emergency_contact_phone',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Método para crear el usuario asociado
    public function createUserAccount()
    {
        $user = User::create([
            'name' => $this->name,
            'user' => $this->dni, // Puedes usar otro campo como nombre de usuario si lo prefieres
            'email' => $this->email,
            'role' => 'Medico', // Rol por defecto para los pacientes
            'password' => Hash::make($this->dni),
        ]);

        $user->asignRole('Paciente');

        $this->user_id = $user->id;
        $this->save();
    }
}
