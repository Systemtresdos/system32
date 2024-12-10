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
    public static function get_validate(){
        return [
            'nombre' => ['required', 'string', 'max:16'],
            'apellido' => ['required', 'string', 'max:16'],
            'nacimiento' => ['required', 'date'],
            'email' => ['required', 'email'],
            'rol_fk' => ['required', 'exists:rols,id']
        ];
    }
    public static function get_labels(){
        
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
    public static function get_fkLabels(){
        return [
            [
                'name' => 'Rol',
                'attr' => 'rol_fk',//Este se usara como un identificador para get_fk
                'fk_name' => 'nombre',
                'fk_id' => 'id',
                'data' => Rol::select('id', 'nombre')->get(),
            ],
        ];
    }
}
