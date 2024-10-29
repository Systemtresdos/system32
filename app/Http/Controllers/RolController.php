<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $rol = new Rol();
        $arregloDatos = $rol->data();
        $datos = Rol::all();
        $nombre = "Rol";
        $fk = [];
        return view('crud', compact('datos','arregloDatos','nombre','fk'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'cargo' => ['required', 'string', 'max:255'],
        ]);
        // Guardar en la base de datos
        Rol::create([
            'nombre' => $request->nombre,
            'cargo' => $request->cargo,
        ]);
        return redirect()->route('Rol.index')
            ->with('success', 'Rol creado exitosamente.')
        ;
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
    public function show(rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rol $rol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rol $rol)
    {
        //
    }
}
