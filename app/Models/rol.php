<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable = [
        'nombre',
        'cargo',
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
                    'dName' => 'Cargo',
                    'name' => 'cargo',
                    'type' => 'textarea',
                ],
            ],
        ];
    }
}
