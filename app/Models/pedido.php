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
    public static function get_validate(){
        return [
            'stock' => ['required', 'integer','min:0','max:999999'],
            'compra_fk' => ['required', 'exists:compras,id'],
            'producto_fk' => ['required', 'exists:productos,id']
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
                    'dName' => 'Cantidad',
                    'name' => 'cantidad',
                    'type' => 'number',
                ],
            ],
        ];
    }
    public static function get_fkLabels(){
        return [
            [
                'name' => 'Compra',
                'attr' => 'compra_fk',
                'fk_name' => 'id',
                'fk_id' => 'id',
                'data' => Compra::select('id')->get(),
            ],
            [
                'name' => 'Producto',
                'attr' => 'producto_fk',
                'fk_name' => 'nombre',
                'fk_id' => 'id',
                'data' => Producto::select('id', 'nombre')->get(),
            ],
        ];
    }
}
