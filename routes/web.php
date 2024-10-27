<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crud-usuario', [UsuarioController::class, 'index'])->name('crud');
Route::get('/crud-rol', [RolController::class, 'index'])->name('crud');

Route::get('/dm', function () {
    return view('dm');
});

Auth::routes();
