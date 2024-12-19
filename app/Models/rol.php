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
                    'display-name' => 'Ver crud',
                    'name' => 'ver_crud',
                    'type' => 'switch',
                ],
                [
                    'display-name' => 'Crear crud',
                    'name' => 'crear_crud',
                    'type' => 'switch',
                ],
                [
                    'display-name' => 'Modificar crud',
                    'name' => 'modificar_crud',
                    'type' => 'switch',
                ],
                [
                    'display-name' => 'Desactivar crud',
                    'name' => 'desactivar_crud',
                    'type' => 'switch',
                ],
                [
                    'display-name' => 'Eliminar crud',
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
