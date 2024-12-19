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
    public static function get_validate(){
        return [
            'nombre' => ['required', 'string', 'max:16'],
            'descripcion' => ['required', 'string', 'max:255'],
        ];
    }
    public static function get_labels(){
        return 
        [
            'data' => [
                [
                    'display-name' => 'ID',
                    'name' => 'id',
                    'type' => 'auto',
                ],
                [
                    'display-name' => 'Nombre',
                    'name' => 'nombre',
                    'type' => 'text',
                ],
                [
                    'display-name' => 'Descripcion',
                    'name' => 'descripcion',
                    'type' => 'textarea',
                ],
            ],
        ];
    }
    public static function get_fkLabels(){
        return [];
    }
}
