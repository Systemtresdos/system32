<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    #Variable $nombre por que me da flojera cambiar datos para todos los usuarios
    public $ClaseNombre = 'producto';
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $dato = new Producto();
        $arregloDatos = $dato->data();
        $datos = Producto::all();
        $nombre = ucfirst($this->ClaseNombre);
        $fk = [
            [
                'name' => 'Marca',
                'attr' => 'marca_fk',
                'fk_name' => 'nombre',
                'fk_id' => 'id',
                'data' => Marca::select('id', 'nombre')->get(),
            ],
        ];
        return view('crud', compact('datos','arregloDatos','nombre','fk'));
    }
    private function valitade(Request $request){
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:512'],
            'precio' => ['required', 'number'],
            'stock' => ['required', 'number'],
        ]);
    }
    public function create(Request $request)
    {
        $this->valitade($request);

        // Guardar en la base de datos
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'marca_fk' => $request->marca_fk,
        ]);
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' creado exitosamente.');
    }
    public function edit(Request $request)
    {
        $this->valitade($request);
        
        $dato = Producto::find($request->id);
        
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        
        // Actualizar dato
        $dato->nombre = $request->nombre;
        $dato->descripcion = $request->descripcion;
        $dato->precio = $request->precio;
        $dato->stock = $request->stock;
        $dato->marca_fk = $request->marca_fk;

        $dato->save();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' modificado exitosamente.');
    }
    public function delete(Request $request)
    {
        
        $dato = Producto::find($request->id);
        
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        $dato->delete();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' eliminado exitosamente.');
    }
}
