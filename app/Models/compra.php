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
    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usuario_fk');
    }
    public function get_fk(){   
        if($this->usuario){
            return [
                'usuario_fk' => $this->usuario->email,
            ];
        }else{
            return[
                'usuario_fk' => 'No encontrado'
            ];
        }
    }
    public static function get_validate(){
        return [
            'precio_total' => ['required', 'numeric','min:0','max:999999'],
            'tipo_pago' => ['required', 'integer','min:1','max:4'],
            'estado_pago' => ['required', 'integer', 'min:1', 'max:2'],
            'usuario_fk' => ['required', 'exists:usuarios,id']
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
    public static function get_fkLabels(){
        return [
            [
                'name' => 'Usuario',
                'attr' => 'usuario_fk',//Este se usara como un identificador para get_fk
                'fk_name' => 'email',
                'fk_id' => 'id',
                'data' => Usuario::select('id', 'email')->get(),
            ],
        ];
    }
}
