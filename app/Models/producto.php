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
        'marca_fk',
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
    public static function get_validate(){
        return [
            'nombre' => ['required', 'string', 'max:64'],
            'descripcion' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric','min:0','max:999999'],
            'stock' => ['required', 'integer','min:0','max:999999'],
            'marca_fk' => ['required', 'exists:marcas,id']
        ];
    }
    public static function get_labels(){
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
                    'type' => 'decimal',
                ],
                [
                    'dName' => 'Stock',
                    'name' => 'stock',
                    'type' => 'number',
                ],
            ],
        ];
    }
    public static function get_fkLabels(){
        return [
            [
                'name' => 'Marca',
                'attr' => 'marca_fk',
                'fk_name' => 'nombre',
                'fk_id' => 'id',
                'data' => Marca::select('id', 'nombre')->get(),
            ],
        ];
    }
}
