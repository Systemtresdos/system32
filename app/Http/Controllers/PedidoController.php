<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    #Variable $nombre por que me da flojera cambiar datos para todos los usuarios
    public $ClaseNombre = 'pedido';
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $dato = new Pedido();
        $arregloDatos = $dato->data();
        $datos = Pedido::all();
        $nombre = ucfirst($this->ClaseNombre);
        $fk = [
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
        return view('crud', compact('datos','arregloDatos','nombre','fk'));
    }
    private function valitade(Request $request){
        $request->validate([
            'cantidad' => ['required', 'integer'],
        ]);
    }
    public function create(Request $request)
    {
        $this->valitade($request);

        // Guardar en la base de datos
        Pedido::create([
            'cantidad' => $request->cantidad,
            'compra_fk' => $request->compra_fk,
            'producto_fk' => $request->producto_fk,
        ]);
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' creado exitosamente.');
    }
    public function edit(Request $request)
    {
        $this->valitade($request);
        
        $dato = Pedido::find($request->id);
        
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }

        // Actualizar dato
        $dato->cantidad = $request->cantidad;
        $dato->compra_fk = $request->compra_fk;
        $dato->producto_fk = $request->producto_fk;

        $dato->save();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' modificado exitosamente.');
    }
    public function delete(Request $request)
    {
        
        $dato = Pedido::find($request->id);
        
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        $dato->delete();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' eliminado exitosamente.');
    }
}
