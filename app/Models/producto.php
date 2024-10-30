<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
    ];
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_fk');
    }
    public function get_fk()
    {
        return [
            'marca_fk' => $this->marca->nombre,
        ];
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
                [
                    'dName' => 'Precio',
                    'name' => 'precio',
                    'type' => 'number',
                ],
                [
                    'dName' => 'Stock',
                    'name' => 'stock',
                    'type' => 'number',
                ],
            ],
        ];
    }
}
