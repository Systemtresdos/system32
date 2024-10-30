<?php

use Illuminate\Support\Facades\Route;
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
    return redirect('/usuario');
});

Route::get('/usuario', [UsuarioController::class, 'index'])->name('Usuario.index');
Route::post('/usuario/crear', [UsuarioController::class, 'create'])->name('Usuario.create');
Route::post('/usuario/editar', [UsuarioController::class, 'edit'])->name('Usuario.edit');
Route::post('/usuario/eliminar', [UsuarioController::class, 'delete'])->name('Usuario.delete');

Route::get('/rol', [RolController::class, 'index'])->name('Rol.index');
Route::post('/rol/crear', [RolController::class, 'create'])->name('Rol.create');
Route::post('/rol/editar', [RolController::class, 'edit'])->name('Rol.edit');
Route::post('/rol/eliminar', [RolController::class, 'delete'])->name('Rol.delete');

Route::get('/marca', [MarcaController::class, 'index'])->name('Marca.index');
Route::post('/marca/crear', [MarcaController::class, 'create'])->name('Marca.create');
Route::post('/marca/editar', [MarcaController::class, 'edit'])->name('Marca.edit');
Route::post('/marca/eliminar', [MarcaController::class, 'delete'])->name('Marca.delete');

Route::get('/producto', [ProductoController::class, 'index'])->name('Producto.index');
Route::post('/producto/crear', [ProductoController::class, 'create'])->name('Producto.create');
Route::post('/producto/editar', [ProductoController::class, 'edit'])->name('Producto.edit');
Route::post('/producto/eliminar', [ProductoController::class, 'delete'])->name('Producto.delete');

Route::get('/pedido', [PedidoController::class, 'index'])->name('Pedido.index');
Route::post('/pedido/crear', [PedidoController::class, 'create'])->name('Pedido.create');
Route::post('/pedido/editar', [PedidoController::class, 'edit'])->name('Pedido.edit');
Route::post('/pedido/eliminar', [PedidoController::class, 'delete'])->name('Pedido.delete');

Route::get('/compra', [CompraController::class, 'index'])->name('Compra.index');
Route::post('/compra/crear', [CompraController::class, 'create'])->name('Compra.create');
Route::post('/compra/editar', [CompraController::class, 'edit'])->name('Compra.edit');
Route::post('/compra/eliminar', [CompraController::class, 'delete'])->name('Compra.delete');


Auth::routes();
