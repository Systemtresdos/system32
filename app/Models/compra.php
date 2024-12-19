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
                    'display-name' => 'ID',
                    'name' => 'id',
                    'type' => 'auto',
                ],
                [
                    'display-name' => 'Tipo de pago',
                    'name' => 'tipo_pago',
                    'type' => 'enum',
                    'enum' => [
                        ['display-name' => 'Tarjeta de credito', 'name' => 'tarjeta_credito'],
                        ['display-name' => 'Paypal', 'name' => 'paypal'],
                        ['display-name' => 'Bitcoin', 'name' => 'bitcoin'],
                        ['display-name' => 'Credito de tienda', 'name' => 'credito_tienda'],
                    ],
                ],
                [
                    'display-name' => 'Estado de pago',
                    'name' => 'estado_pago',
                    'type' => 'enum',
                    'enum' => [
                        ['display-name' => 'Completado', 'name' => 'completado'],
                        ['display-name' => 'Pendiente', 'name' => 'pendiente'],
                    ],
                ],
                [
                    'display-name' => 'Precio total',
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
