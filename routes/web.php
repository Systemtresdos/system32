<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CompraController;

Route::get('/', function () {
    if (!Auth::user()) {
        return redirect('/login');
    }
    return redirect('/crud');
});

Route::get('/crud', function (Request $request) {
    return CrudController::index($request);
});
Route::post('/crud/crear', function (Request $request) {
    return CrudController::create($request);
});
Route::post('/crud/editar', function (Request $request) {
    return CrudController::edit($request);
});
Route::post('/crud/eliminar', function (Request $request) {
    return CrudController::delete($request);
});

Auth::routes();
