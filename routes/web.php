<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\MarcaVehiculoController;
use App\Http\Controllers\ModelVehiculoController;
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
    Route::put('/actualizar-productos/{productos_id}', [ProductosController::class, 'update'])->name('productos.update');
    Route::delete('/eliminar-categorias/{productos_eliminar}', [ProductosController::class, 'destroyer'])->name('productos.delete');

    Route::get('/ver-categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/crear-categorias', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::get('/editar-categorias/{categorias_edit}', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::get('/buscar-categorias', [CategoriasController::class, 'search'])->name('categorias.buscar');
    Route::post('/agregar-categorias', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::put('/actualizar-categorias/{categorias_id}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/eliminar-categorias/{categorias_eliminar}', [CategoriasController::class, 'destroyer'])->name('categorias.delete');


    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/agregar-clientes', [ClientesController::class, 'create'])->name('clientes.create');
    Route::get('/editar-clientes/{clientes_edit}', [ClientesController::class, 'edit'])->name('clientes.edit');
    Route::get('/buscar-clientes', [ClientesController::class, 'search'])->name('clientes.buscar');
    Route::post('/agregar-clientes', [ClientesController::class, 'store'])->name('clientes.store');
    Route::put('/actualizar-clientes/{clientes_id}', [ClientesController::class, 'update'])->name('clientes.update');
    Route::delete('/eliminar-clientes/{clientes_eliminar}', [ClientesController::class, 'destroyer'])->name('clientes.delete');


    Route::get('/vehiculos', [VehiculosController::class, 'index'])->name('vehiculos.index');
    Route::get('/agregar-vehiculos', [VehiculosController::class, 'create'])->name('vehiculos.create');
    Route::get('/editar-vehiculos/{vehiculos_edit}', [VehiculosController::class, 'edit'])->name('vehiculos.edit');
    Route::get('/buscar-vehiculos', [VehiculosController::class, 'search'])->name('vehiculos.buscar');
    Route::post('/agregar-vehiculos', [VehiculosController::class, 'store'])->name('vehiculos.store');
    Route::put('/actualizar-vehiculos/{vehiculos_id}', [VehiculosController::class, 'update'])->name('vehiculos.update');
    Route::delete('/eliminar-vehiculos/{vehiculos_eliminar}', [VehiculosController::class, 'destroyer'])->name('vehiculos.delete');

    Route::get('/marcas-vehiculos', [MarcaVehiculoController::class, 'index'])->name('marcas.index');
    Route::get('/agregar-marcas-vehiculos', [MarcaVehiculoController::class, 'create'])->name('marcas.create');
    Route::get('/editar-marcas-vehiculos/{marcas_edit}', [MarcaVehiculoController::class, 'edit'])->name('marcas.edit');
    Route::get('/buscar-marcas-vehiculos', [MarcaVehiculoController::class, 'search'])->name(name: 'marcas.buscar');
    Route::post('/agregar-marcas-vehiculos', [MarcaVehiculoController::class, 'store'])->name('marcas.store');
    Route::put('/actualizar-marcas-vehiculos/{marcas_id}', [MarcaVehiculoController::class, 'update'])->name('marcas.update');
    Route::delete('/eliminar-marcas-vehiculos/{marcas_eliminar}', [MarcaVehiculoController::class, 'destroyer'])->name('marcas.delete');

    Route::get('/modelos-vehiculos', [ModelVehiculoController::class, 'index'])->name('modelos.index');
    Route::get('/agregar-modelos-vehiculos', [ModelVehiculoController::class, 'create'])->name('modelos.create');
    Route::get('/editar-modelos-vehiculos/{modelos_edit}', [ModelVehiculoController::class, 'edit'])->name('modelos.edit');
    Route::get('/buscar-modelos-vehiculos', [ModelVehiculoController::class, 'search'])->name('modelos.buscar');
    Route::post('/agregar-modelos-vehiculos', [ModelVehiculoController::class, 'store'])->name('modelos.store');
    Route::put('/actualizar-modelos-vehiculos/{modelos_id}', [ModelVehiculoController::class, 'update'])->name('modelos.update');
    Route::delete('/eliminar-modelos-vehiculos/{modelos_eliminar}', [ModelVehiculoController::class, 'destroyer'])->name('modelos.delete');


    Route::get('/servicios', [ServiciosController::class, 'index'])->name('servicios.index');
    Route::get('/agregar-servicios', [ServiciosController::class, 'create'])->name('servicios.create');
    Route::get('/editar-servicios/{servicios_edit}', [ServiciosController::class, 'edit'])->name('servicios.edit');
    Route::get('/buscar-servicios', [ServiciosController::class, 'search'])->name('servicios.buscar');
    Route::post('/agregar-servicios', [ServiciosController::class, 'store'])->name('servicios.store');
    Route::put('/actualizar-servicios/{servicios_id}', [ServiciosController::class, 'update'])->name('servicios.update');
    Route::delete('/eliminar-servicios/{servicios_eliminar}', [ServiciosController::class, 'destroyer'])->name('servicios.delete');


    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::get('/agregar-ventas', [VentasController::class, 'create'])->name('ventas.create');
    Route::get('/editar-ventas/{ventas_edit}', [ServiciosController::class, 'edit'])->name('ventas.edit');
    Route::get('/buscar-ventas', [ServiciosController::class, 'search'])->name('ventas.buscar');
    Route::post('/agregar-ventas', [ServiciosController::class, 'store'])->name('ventas.store');
    Route::put('/actualizar-ventas/{ventas_id}', [ServiciosController::class, 'update'])->name('ventas.update');
    Route::delete('/eliminar-ventas/{ventas}', [ServiciosController::class, 'destroyer'])->name('ventas.delete');


    Route::get('/facturas', [FacturasController::class, 'index'])->name('facturas.index');
    Route::get('/agregar-facturas', [FacturasController::class, 'create'])->name('facturas.create');

    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/agregar-usuarios', [UsuariosController::class, 'create'])->name('usuarios.create');

    Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');
    Route::get('/agregar-empleados', [EmpleadosController::class, 'create'])->name('empleados.create');
});

require __DIR__ . '/auth.php';
