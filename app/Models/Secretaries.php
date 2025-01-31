<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Secretaries extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'dni',
        'name',
        'last_name',
        'address',
        'phone',
        'email',
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
            'name' => $this->name,
            'email' => $this->email,
            'user' => $this->dni, // Puedes usar otro campo como nombre de usuario si lo prefieres
            'role' => 'Secretaria', // Rol por defecto para los pacientes
            'password' => Hash::make($this->dni),
        ]);

        $this->user_id = $user->id;
        $this->save();
    }
}
