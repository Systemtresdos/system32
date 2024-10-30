<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crud-usuario', [UsuarioController::class, 'index'])->name('Usuario.index');
Route::post('/crud-usuario/crear', [UsuarioController::class, 'create'])->name('Usuario.create');
Route::post('/crud-usuario/editar', [UsuarioController::class, 'edit'])->name('Usuario.edit');
Route::post('/crud-usuario/eliminar', [UsuarioController::class, 'delete'])->name('Usuario.delete');

Route::get('/crud-rol', [RolController::class, 'index'])->name('Rol.index');
Route::post('/crud-rol/crear', [RolController::class, 'create'])->name('Rol.create');



Route::get('/dm', function () {
    return view('dm');
});

Auth::routes();
