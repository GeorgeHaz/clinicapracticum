<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'user',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'Administrador';
    }

    public function isDoctor()
    {
        return $this->role === 'Medico';
    }

    public function isSecretary()
    {
        return $this->role === 'Secretaria';
    }

    public function isGuest()
    {
        return $this->role === 'Invitado';
    }

    /*public function specialty()
    {
        return $this->belongsTo(Specialties::class, 'specialties_id');
    }
    // Si un usuario puede tener varias especialidades (relación muchos a muchos)
    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialties::class, 'user_specialty', 'user_id', 'specialty_id');
    }*/
}
