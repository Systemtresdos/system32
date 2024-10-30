<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = [
        'tipo_pago',
        'estado_pago',
        'precio_total',
        'usuario_fk',
    ];
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_fk');
    }
    public function get_fk()
    {   
        if($this->usuario){
        return [
            'usuario_fk' => $this->usuario->nombre,
        ];
        }else{
            return[
                'usuario_fk' => 'No encontrado'
            ];
        }
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
                    'dName' => 'Tipo de pago',
                    'name' => 'tipo_pago',
                    'type' => 'enum',
                    'enum' => [
                        ['dName' => 'Tarjeta de credito', 'name' => 'tarjeta_credito'],
                        ['dName' => 'Paypal', 'name' => 'paypal'],
                        ['dName' => 'Bitcoin', 'name' => 'bitcoin'],
                        ['dName' => 'Credito de tienda', 'name' => 'credito_tienda'],
                    ],
                ],
                [
                    'dName' => 'Estado de pago',
                    'name' => 'estado_pago',
                    'type' => 'enum',
                    'enum' => [
                        ['dName' => 'Completado', 'name' => 'completado'],
                        ['dName' => 'Pendiente', 'name' => 'pendiente'],
                    ],
                ],
                [
                    'dName' => 'Precio total',
                    'name' => 'precio_total',
                    'type' => 'number',
                ],
            ],
        ];
    }
}
