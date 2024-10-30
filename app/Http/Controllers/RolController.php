<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RolController extends Controller
{
    public $ClaseNombre = 'rol';
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $rol = new Rol();
        $arregloDatos = $rol->data();
        $datos = Rol::all();
        $nombre = ucfirst($this->ClaseNombre);
        $fk = [];
        return view('crud', compact('datos','arregloDatos','nombre','fk'));
    }
    private function valitade(Request $request){
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'cargo' => ['required', 'string', 'max:512'],
        ]);
    }
    public function create(Request $request)
    {
        $this->valitade($request);
        // Guardar en la base de datos
        Rol::create([
            'nombre' => $request->nombre,
            'cargo' => $request->cargo,
        ]);
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
            ->with('success', ucfirst($this->ClaseNombre).' creado exitosamente.')
        ;
    }
    public function edit(Request $request)
    {
        $this->valitade($request);
        $dato = Rol::find($request->id);
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        // Actualizar dato
        $dato->nombre = $request->nombre;
        $dato->cargo = $request->cargo;
        $dato->save();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' modificado exitosamente.');
    }
    public function delete(Request $request)
    {
        $dato = Rol::find($request->id);
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        $dato->delete();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' eliminado exitosamente.');
    }
}
