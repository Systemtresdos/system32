<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    #Variable $nombre por que me da flojera cambiar datos para todos los usuarios
    public $ClaseNombre = 'usuario';
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $dato = new Usuario();
        $arregloDatos = $dato->data();
        $datos = Usuario::all();
        $nombre = ucfirst($this->ClaseNombre);
        $fk = [
            [
                'name' => 'Rol',
                'attr' => 'rol_fk',//Este se usara como un identificador para get_fk
                'fk_name' => 'nombre',
                'fk_id' => 'id',
                'data' => Rol::select('id', 'nombre')->get(),
            ],
        ];
        return view('crud', compact('datos','arregloDatos','nombre','fk'));
    }
    private function valitade(Request $request){
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'nacimiento' => ['required', 'date'],
        ]);
    }
    public function create(Request $request)
    {
        $this->valitade($request);
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.$this->ClaseNombre.'s'],
        ]);

        // Guardar en la base de datos
        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'nacimiento' => $request->nacimiento,
            'email' => $request->email,
            'password' => Hash::make('123abc'),
            'rol_fk' => $request->rol_fk,
        ]);
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' creado exitosamente.')
        ->with('warning', 'La contraseña por defecto es: 123abc.');
    }
    public function edit(Request $request)
    {
        $this->valitade($request);
        
        $dato = Usuario::find($request->id);
        
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }
        
        $request->validate([
            'email' => [Rule::unique($this->ClaseNombre.'s')->ignore($dato->id)],
        ]);
        // Actualizar dato
        $dato->nombre = $request->nombre;
        $dato->apellido = $request->apellido;
        $dato->nacimiento = $request->nacimiento;
        $dato->email = $request->email;
        $dato->rol_fk = $request->rol_fk;

        $dato->save();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' modificado exitosamente.');
    }
    public function delete(Request $request)
    {
        
        $dato = Usuario::find($request->id);
        
        if (!$dato) {
            return redirect()->back()->with('error', ucfirst($this->ClaseNombre).' no encontrado.');
        }

        $dato->delete();
        return redirect()->route(ucfirst($this->ClaseNombre).'.index')
        ->with('success', ucfirst($this->ClaseNombre).' eliminado exitosamente.');
    }
}
