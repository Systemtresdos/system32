<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'cantidad',
        'compra_fk',
        'producto_fk',
    ];
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_fk');
    }
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_fk');
    }
    public function get_fk()
    {   
        return [
            'compra_fk' => $this->compra->id,
            'producto_fk' => $this->producto->nombre,
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
                    'dName' => 'Cantidad',
                    'name' => 'cantidad',
                    'type' => 'number',
                ],
            ],
        ];
    }
}
