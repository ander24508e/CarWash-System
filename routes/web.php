<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\Productos;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/menu', function () {
    return view('menu');
})->middleware(['auth', 'verified'])->name('menu');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
    Route::get('/agregar-productos', [ProductosController::class, 'create'])->name('productos.create');
    Route::get('/editar-productos/{productos_edit}', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::get('/buscar-productos', [ProductosController::class, 'search'])->name('productos.buscar');
    Route::post('/agregar-productos', [ProductosController::class, 'store'])->name('productos.store');    
    Route::put('/actualizar-productos/{prodcutos_id}', [ProductosController::class, 'update'])->name('productos.update');
    Route::delete('/eliminar-categorias/{productos_eliminar}', [ProductosController::class, 'destroyer'])->name('productos.delete');


    Route::get('/ver-categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/crear-categorias', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::get('/editar-categorias/{categorias_edit}', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::get('/buscar-categorias', [CategoriasController::class, 'search'])->name('categorias.buscar');
    Route::post('/agregar-categorias', [CategoriasController::class, 'store'])->name('categorias.store');    
    Route::put('/actualizar-categorias/{categorias_id}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/eliminar-categorias/{categorias_eliminar}', [CategoriasController::class, 'destroyer'])->name('categorias.delete');
    

    Route::get('/clientes', [ClientesController::class, 'index'])->name('cliente.index');
    Route::get('/agregar-clientes', [ClientesController::class, 'create'])->name('cliente.create');

    Route::Get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::get('/agregar-ventas', [VentasController::class, 'create'])->name('ventas.create');

    Route::Get('/facturas', [FacturasController::class, 'index'])->name('facturas.index');
    Route::get('/agregar-facturas', [FacturasController::class, 'create'])->name('facturas.create');

    Route::Get('/servicios', [ServiciosController::class, 'index'])->name('servicios.index');
    Route::get('/agregar-servicios', [ServiciosController::class, 'create'])->name('servicios.create');

    Route::Get('/vehiculos', [VehiculosController::class, 'index'])->name('vehiculos.index');
    Route::get('/agregar-vehiculos', [VehiculosController::class, 'create'])->name('vehiculos.create');

    Route::Get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/agregar-usuarios', [UsuariosController::class, 'create'])->name('usuarios.create');

    Route::Get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');
    Route::get('/agregar-empleados', [EmpleadosController::class, 'create'])->name('empleados.create');
});

require __DIR__ . '/auth.php';
