<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];
    public function get_fk()
    {
        return [];
    }
    public function data(){
        return 
        [
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
                    'dName' => 'Descripcion',
                    'name' => 'descripcion',
                    'type' => 'textarea',
                ],
            ],
        ];
    }
}
