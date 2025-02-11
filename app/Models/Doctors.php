<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Doctors extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'dni',
        'name',
        'last_name',
        'email',
        'specialty_id',
        'address',
        'phone',
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
            'user' => $this->dni, // Puedes usar otro campo como nombre de usuario si lo prefieres
            'email' => $this->email,
            'password' => Hash::make($this->dni),
        ]);
        $user->assignRole('Medico');

        $this->user_id = $user->id;
        $this->save();
    }
    
    public function specialty()
    {
        return $this->belongsTo(Specialties::class, 'specialty_id');
    }
}
