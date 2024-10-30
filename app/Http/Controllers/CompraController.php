<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public $ClaseNombre = 'compra';
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $dato = new Compra();
        $arregloDatos = $dato->data();
        $datos = Compra::all();
        $nombre = ucfirst($this->ClaseNombre);
        $fk = [
            [
                'name' => 'Usuario',
                'attr' => 'usuario_fk',//Este se usara como un identificador para get_fk
                'fk_name' => 'nombre',
                'fk_id' => 'id',
                'data' => Usuario::select('id', 'nombre')->get(),
            ],
        ];
        return view('crud', compact('datos','arregloDatos','nombre','fk'));
    }
    private function valitade(Request $request){
        $request->validate([
            'precio_total' => ['required', 'numeric'],
        ]);
    }
    public function create(Request $request)
    {
        $this->valitade($request);
        // Guardar en la base de datos
        Compra::create([
            'tipo_pago' => $request->tipo_pago,
            'estado_pago' => $request->estado_pago,
            'precio_total' => $request->precio_total,
            'usuario_fk' => $request->usuario_fk,
        ]);
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
            ->with('success', ucfirst($this->ClaseNombre).' creado exitosamente.')
        ;
    }
    public function edit(Request $request)
    {
        $this->valitade($request);
        $dato = Compra::find($request->id);
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        // Actualizar dato
        $dato->tipo_pago = $request->tipo_pago;
        $dato->estado_pago = $request->estado_pago;
        $dato->precio_total = $request->precio_total;
        $dato->usuario_fk = $request->usuario_fk;
        $dato->save();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' modificado exitosamente.');
    }
    public function delete(Request $request)
    {
        $dato = Compra::find($request->id);
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        $dato->delete();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' eliminado exitosamente.');
    }
}
