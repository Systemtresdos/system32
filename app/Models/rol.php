<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = [
        'nombre',
        'ver_crud',
        'crear_crud',
        'modificar_crud',
        'desactivar_crud',
        'eliminar_crud',
    ];
    public function get_fk()
    {
        return [];
    }
    public static function get_validate(){
        return [
            'nombre' => ['required', 'string', 'max:16'],
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
                    'dName' => 'Ver crud',
                    'name' => 'ver_crud',
                    'type' => 'switch',
                ],
                [
                    'dName' => 'Crear crud',
                    'name' => 'crear_crud',
                    'type' => 'switch',
                ],
                [
                    'dName' => 'Modificar crud',
                    'name' => 'modificar_crud',
                    'type' => 'switch',
                ],
                [
                    'dName' => 'Desactivar crud',
                    'name' => 'desactivar_crud',
                    'type' => 'switch',
                ],
                [
                    'dName' => 'Eliminar crud',
                    'name' => 'eliminar_crud',
                    'type' => 'switch',
                ],
            ],
        ];
    }
    public static function get_fkLabels(){
        return [];
    }
}
