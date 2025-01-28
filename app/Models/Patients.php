<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Patients extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'last_name',
        'dni',
        'birthdate',
        'gener',
        'direction',
        'telephone',
        'email',
        'blood_group',
        'allergies',
        'diseases',
        'emergency_contact_name',
        'emergency_contact_telephone',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Método para crear el usuario asociado
    public function createUserAccount()
    {
        $user = User::create([
            'dni' => $this->dni,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'direction'=>$this->direction,
            'telephone'=>$this->telephone,
            'user' => $this->dni, // Puedes usar otro campo como nombre de usuario si lo prefieres
            'rol' => 'Paciente', // Rol por defecto para los pacientes
            'password' => Hash::make($this->dni),
        ]);

        $this->user_id = $user->id;
        $this->save();
    }
}
