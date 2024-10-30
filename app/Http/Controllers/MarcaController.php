<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarcaController extends Controller
{
    #Variable $nombre por que me da flojera cambiar datos para todos los usuarios
    public $ClaseNombre = 'marca';
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $rol = new Marca();
        $arregloDatos = $rol->data();
        $datos = Marca::all();
        $nombre = ucfirst($this->ClaseNombre);
        $fk = [];
        return view('crud', compact('datos','arregloDatos','nombre','fk'));
    }
    private function valitade(Request $request){
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:512'],
        ]);
    }
    public function create(Request $request)
    {
        $this->valitade($request);
        // Guardar en la base de datos
        Marca::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
            ->with('success', ucfirst($this->ClaseNombre).' creado exitosamente.')
        ;
    }
    public function edit(Request $request)
    {
        $this->valitade($request);
        $dato = Marca::find($request->id);
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        // Actualizar dato
        $dato->nombre = $request->nombre;
        $dato->descripcion = $request->descripcion;
        $dato->save();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' modificado exitosamente.');
    }
    public function delete(Request $request)
    {
        $dato = Marca::find($request->id);
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        $dato->delete();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' eliminado exitosamente.');
    }
}
