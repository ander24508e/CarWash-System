<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaController;
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
| SISTEMA DE GESTIÓN CARWASH
|--------------------------------------------------------------------------
| Estructura de roles:
| - admin: Acceso total al sistema (gestión completa)
| - user (empleado): Ventas y operaciones diarias
| - client: Vista de sus servicios y vehículos
|--------------------------------------------------------------------------
*/

// ============================================================================
// RUTA PÚBLICA - LOGIN
// ============================================================================
// Redirecciona a la página de login cuando no hay sesión activa
Route::get('/', function () {
    return view('auth.login');
});

// ============================================================================
// GRUPO: RUTAS AUTENTICADAS (Requiere login)
// ============================================================================
Route::middleware('auth')->group(function () {

    // ========================================================================
    // DASHBOARDS - Acceso según rol del usuario
    // ========================================================================
    // Ruta principal que redirecciona según el rol del usuario autenticado
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/menu', [DashboardController::class, 'index'])->name('menu');

    // Dashboard Admin (solo admin)
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('dashboard.admin');

    // Dashboard Empleado (admin y empleados)
    Route::get('/dashboard/empleado', [DashboardController::class, 'empleado'])
        ->middleware('role:admin|user')
        ->name('dashboard.empleado');

    // Dashboard Cliente (comentado - futuro)
    // Route::get('/dashboard/cliente', [DashboardController::class, 'cliente'])
    //     ->middleware('role:client')
    //     ->name('dashboard.cliente');

    // Estadísticas en tiempo real (AJAX) - Solo Admin
    Route::get('/dashboard/stats/realtime', [DashboardController::class, 'getRealtimeStats'])
        ->middleware('role:admin')
        ->name('dashboard.realtime');

    // ========================================================================
    // PERFIL DE USUARIO - Accesible para todos los usuarios autenticados
    // ========================================================================
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // ========================================================================
    // GRUPO: RUTAS EXCLUSIVAS PARA ADMINISTRADORES
    // ========================================================================
    // Solo los usuarios con rol 'admin' pueden acceder a estas rutas
    Route::middleware('role:admin')->group(function () {

        // --------------------------------------------------------------------
        // EMPRESA - Configuración general del negocio
        // --------------------------------------------------------------------
        // Gestiona: Nombre, dirección, teléfono, logo de la empresa
        Route::prefix('empresa')->name('empresa.')->group(function () {
            Route::get('/', [EmpresaController::class, 'edit'])->name('edit');
            Route::patch('/', [EmpresaController::class, 'update'])->name('update');
        });

        // --------------------------------------------------------------------
        // USUARIOS - Gestión de cuentas del sistema
        // --------------------------------------------------------------------
        // Gestiona: Admins, Empleados, Clientes (CRUD completo)
        Route::prefix('usuarios')->name('usuarios.')->group(function () {
            Route::get('/', [UsuariosController::class, 'index'])->name('index');
            Route::get('/agregar', [UsuariosController::class, 'create'])->name('create');
            Route::post('/agregar', [UsuariosController::class, 'store'])->name('store');
            Route::get('/editar/{usuario}', [UsuariosController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{usuario}', [UsuariosController::class, 'update'])->name('update');
            Route::delete('/eliminar/{usuario}', [UsuariosController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [UsuariosController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // CLIENTES - Gestión de clientes del carwash
        // --------------------------------------------------------------------
        // Gestiona: Datos personales, historial de servicios
        Route::prefix('clientes')->name('clientes.')->group(function () {
            Route::get('/', [ClientesController::class, 'index'])->name('index');
            Route::get('/agregar', [ClientesController::class, 'create'])->name('create');
            Route::post('/agregar', [ClientesController::class, 'store'])->name('store');
            Route::get('/editar/{cliente}', [ClientesController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{cliente}', [ClientesController::class, 'update'])->name('update');
            Route::delete('/eliminar/{cliente}', [ClientesController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [ClientesController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // VEHÍCULOS - Gestión de vehículos registrados
        // --------------------------------------------------------------------
        // Gestiona: Placas, marcas, modelos, colores de vehículos
        Route::prefix('vehiculos')->name('vehiculos.')->group(function () {
            Route::get('/', [VehiculosController::class, 'index'])->name('index');
            Route::get('/agregar', [VehiculosController::class, 'create'])->name('create');
            Route::post('/agregar', [VehiculosController::class, 'store'])->name('store');
            Route::get('/editar/{vehiculo}', [VehiculosController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{vehiculo}', [VehiculosController::class, 'update'])->name('update');
            Route::delete('/eliminar/{vehiculo}', [VehiculosController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [VehiculosController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // MARCAS DE VEHÍCULOS - Catálogo de marcas
        // --------------------------------------------------------------------
        // Gestiona: Toyota, Chevrolet, Honda, etc.
        Route::prefix('marcas-vehiculos')->name('marcas.')->group(function () {
            Route::get('/', [MarcaVehiculoController::class, 'index'])->name('index');
            Route::get('/agregar', [MarcaVehiculoController::class, 'create'])->name('create');
            Route::post('/agregar', [MarcaVehiculoController::class, 'store'])->name('store');
            Route::get('/editar/{marca}', [MarcaVehiculoController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{marca}', [MarcaVehiculoController::class, 'update'])->name('update');
            Route::delete('/eliminar/{marca}', [MarcaVehiculoController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [MarcaVehiculoController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // MODELOS DE VEHÍCULOS - Catálogo de modelos
        // --------------------------------------------------------------------
        // Gestiona: Corolla, Aveo, Civic, etc. (relacionados con marcas)
        Route::prefix('modelos-vehiculos')->name('modelos.')->group(function () {
            Route::get('/', [ModelVehiculoController::class, 'index'])->name('index');
            Route::get('/agregar', [ModelVehiculoController::class, 'create'])->name('create');
            Route::post('/agregar', [ModelVehiculoController::class, 'store'])->name('store');
            Route::get('/editar/{modelo}', [ModelVehiculoController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{modelo}', [ModelVehiculoController::class, 'update'])->name('update');
            Route::delete('/eliminar/{modelo}', [ModelVehiculoController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [ModelVehiculoController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // SERVICIOS - Catálogo de servicios ofrecidos
        // --------------------------------------------------------------------
        // Gestiona: Lavado Express, Completo, Cambio de Aceite, etc.
        Route::prefix('servicios')->name('servicios.')->group(function () {
            Route::get('/', [ServiciosController::class, 'index'])->name('index');
            Route::get('/agregar', [ServiciosController::class, 'create'])->name('create');
            Route::post('/agregar', [ServiciosController::class, 'store'])->name('store');
            Route::get('/editar/{servicio}', [ServiciosController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{servicio}', [ServiciosController::class, 'update'])->name('update');
            Route::delete('/eliminar/{servicio}', [ServiciosController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [ServiciosController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // PRODUCTOS - Inventario de productos químicos y accesorios
        // --------------------------------------------------------------------
        // Gestiona: Shampoo, cera, limpiadores, control de stock
        Route::prefix('productos')->name('productos.')->group(function () {
            Route::get('/', [ProductosController::class, 'index'])->name('index');
            Route::get('/agregar', [ProductosController::class, 'create'])->name('create');
            Route::post('/agregar', [ProductosController::class, 'store'])->name('store');
            Route::get('/editar/{producto}', [ProductosController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{producto}', [ProductosController::class, 'update'])->name('update');
            Route::delete('/eliminar/{producto}', [ProductosController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [ProductosController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // CATEGORÍAS - Clasificación de productos
        // --------------------------------------------------------------------
        // Gestiona: Limpieza, Encerado, Protección, etc.
        Route::prefix('categorias')->name('categorias.')->group(function () {
            Route::get('/', [CategoriasController::class, 'index'])->name('index');
            Route::get('/crear', [CategoriasController::class, 'create'])->name('create');
            Route::post('/agregar', [CategoriasController::class, 'store'])->name('store');
            Route::get('/editar/{categorias_edit}', [CategoriasController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{categoria}', [CategoriasController::class, 'update'])->name('update');
            Route::delete('/eliminar/{categoria}', [CategoriasController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [CategoriasController::class, 'search'])->name('buscar');
        });

        // --------------------------------------------------------------------
        // FACTURAS - Gestión de facturación
        // --------------------------------------------------------------------
        // Gestiona: Emisión y registro de facturas
        Route::prefix('facturas')->name('facturas.')->group(function () {
            Route::get('/', [FacturasController::class, 'index'])->name('index');
            Route::get('/agregar', [FacturasController::class, 'create'])->name('create');
        });
    });

    // ========================================================================
    // GRUPO: RUTAS PARA ADMINISTRADORES Y EMPLEADOS
    // ========================================================================
    // Accesible por roles: 'admin' y 'user' (empleados)
    Route::middleware('role:admin|user')->group(function () {

        // --------------------------------------------------------------------
        // VENTAS - Registro de servicios realizados
        // --------------------------------------------------------------------
        // Gestiona: Servicios vendidos, cliente, vehículo, empleado, totales
        // Admin: Ve todas las ventas
        // Empleado: Ve solo sus ventas
        Route::prefix('ventas')->name('ventas.')->group(function () {
            Route::get('/', [VentasController::class, 'index'])->name('index');
            Route::get('/agregar', [VentasController::class, 'create'])->name('create');
            Route::post('/agregar', [VentasController::class, 'store'])->name('store');
            Route::get('/editar/{venta}', [VentasController::class, 'edit'])->name('edit');
            Route::put('/actualizar/{venta}', [VentasController::class, 'update'])->name('update');
            Route::delete('/eliminar/{venta}', [VentasController::class, 'destroy'])->name('delete');
            Route::get('/buscar', [VentasController::class, 'search'])->name('buscar');
        });
    });

    // ========================================================================
    // GRUPO: RUTAS PARA CLIENTES (Futuro)
    // ========================================================================
    // Accesible solo por usuarios con rol 'client'
    // NOTA: Descomentar cuando estén listos los métodos en los controladores
    /*
    Route::middleware('role:client')->prefix('cliente')->name('cliente.')->group(function () {

        // Vista de datos personales
        Route::get('/perfil', [ProfileController::class, 'show'])->name('perfil');

        // Mis vehículos registrados
        Route::get('/mis-vehiculos', [VehiculosController::class, 'misVehiculos'])->name('mis-vehiculos');

        // Historial de servicios recibidos
        Route::get('/mis-servicios', [VentasController::class, 'misServicios'])->name('mis-servicios');

        // Agendar nuevo servicio (opcional)
        Route::get('/agendar', [VentasController::class, 'agendar'])->name('agendar');
        Route::post('/agendar', [VentasController::class, 'guardarCita'])->name('guardar-cita');
    });
    */
});

// ============================================================================
// RUTAS DE AUTENTICACIÓN (Login, Registro, Recuperación de contraseña)
// ============================================================================
// Generadas automáticamente por Laravel Breeze/Jetstream
require __DIR__ . '/auth.php';