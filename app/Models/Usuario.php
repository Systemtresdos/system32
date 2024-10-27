<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'nacimiento',
        'email',
        'password',
        'rol_fk',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_fk');
    }
    public function get_fk()
    {
        return [
            'rol_fk' => $this->rol->nombre,
        ];
    }

    public function data(){
        
        return [
            'data' => [
                [
                    'dName' => 'ID',
                    'name' => 'id',
                    'type' => 'auto',
                ],
                [
                    'dName' => 'Nombre',
                    'name' => 'nombre',
                    'type' => 'text',
                ],
                [
                    'dName' => 'Apellido',
                    'name' => 'apellido',
                    'type' => 'text',
                ],
                [
                    'dName' => 'Fecha de nacimiento',
                    'name' => 'nacimiento',
                    'type' => 'date',
                ],
                [
                    'dName' => 'Email',
                    'name' => 'email',
                    'type' => 'email',
                ],
            ],
        ];
    }
}
