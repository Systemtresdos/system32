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

Route::get('/doom', function(){
    return view('doom');
});

Route::get('/crud_update', function () {
    return response()->stream(function () {
        while (true) {
            echo "data: " . json_encode([
                'type' => 'edit',
                'id' => '1',
                'data' => '',
            ]) . "\n\n";
            ob_flush();
            flush();
            sleep(10); // Enviar datos cada 2 segundos
        }
    }, 200, [
        'Content-Type' => 'text/event-stream',
        'Cache-Control' => 'no-cache',
        'Connection' => 'keep-alive',
    ]);
});

Auth::routes();
