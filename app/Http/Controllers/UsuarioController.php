<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $usuario = new Usuario();
        $arregloDatos = $usuario->data();
        $datos = Usuario::all();
        $nombre = "Usuario";
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
    public function create(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'nacimiento' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
        ]);
        // Guardar en la base de datos
        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'nacimiento' => $request->nacimiento,
            'email' => $request->email,
            'password' => Hash::make('abc123'),
            'rol_fk' => $request->rol_fk,
        ]);
        return redirect()->route('Usuario.index')
        ->with('success', 'Usuario creado exitosamente.')
        ->with('warning', 'La contraseña por defecto es: 123abc.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(usuario $usuario)
    {
        //
    }
}
