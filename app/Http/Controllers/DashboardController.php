<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\User;
use App\Models\vehiculos;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Redirige según el rol del usuario
     * Accesible para todos los usuarios autenticados
     */
    public function redirectByRole()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('dashboard.admin');
        } elseif ($user->hasRole('user') || $user->hasRole('empleado')) {
            return redirect()->route('dashboard.empleado');
        } 
        /* COMENTADO TEMPORALMENTE - CLIENTES
        elseif ($user->hasRole('client')) {
            return redirect()->route('dashboard.cliente');
        }
        */
        
        return redirect('/');
    }

    /**
     * Dashboard principal - Redirige según rol
     */
    public function index()
    {
        return $this->redirectByRole();
    }

    /**
     * Dashboard para administradores
     */
    public function admin()
    {
        // Verificar que solo los administradores puedan ver el dashboard
        if (!auth()->user()->hasRole('admin')) {
            return $this->redirectByRole();
        }

        // =============================================
        // ESTADÍSTICAS DE CLIENTES (solo estadísticas, no funcionalidad)
        // =============================================
        $stats_clientes = [
            'total' => User::role('client')->count(),
            'nuevos_mes' => User::role('client')
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
            'activos' => User::role('client')
                ->where('updated_at', '>=', Carbon::now()->subDays(30))
                ->count(),
        ];

        // =============================================
        // ESTADÍSTICAS DE USUARIOS
        // =============================================
        $stats_usuarios = [
            'total' => User::count(),
            'admins' => User::role('admin')->count(),
            'empleados' => User::role('user')->count(),
            'clientes' => User::role('client')->count(),
        ];

        // =============================================
        // ESTADÍSTICAS DE PRODUCTOS
        // =============================================
        $stats_productos = [
            'total' => Productos::count(),
            'stock_bajo' => Productos::where('stock', '<', 10)->count(),
            'sin_stock' => Productos::where('stock', '=', 0)->count(),
            'valor_inventario' => Productos::sum(DB::raw('precio_venta * stock')),
        ];

        // =============================================
        // ESTADÍSTICAS DE SERVICIOS
        // =============================================
        $stats_servicios = [
            'total' => 0,  // Implementar cuando tengas tabla de servicios
            'activos' => 0,
        ];

        // =============================================
        // ESTADÍSTICAS DE VEHÍCULOS
        // =============================================
        $stats_vehiculos = [
            'total' => vehiculos::count(),
        ];

        // =============================================
        // MARCAS DE VEHÍCULOS MÁS FRECUENTES
        // =============================================
        // Usa 'brand_vehicle' que es el nombre de la columna real
        $marcas_populares_raw = vehiculos::select('brand_vehicle', DB::raw('COUNT(*) as total'))
            ->whereNotNull('brand_vehicle')
            ->groupBy('brand_vehicle')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Transformar al formato que espera la vista
        $marcas_populares = $marcas_populares_raw->map(function ($item) {
            return (object) [
                'marca' => (object) ['nombre_marca' => $item->brand_vehicle],
                'total' => $item->total
            ];
        });

        // Si no hay vehículos registrados, datos de ejemplo
        if ($marcas_populares->isEmpty()) {
            $marcas_populares = collect([
                (object) ['marca' => (object) ['nombre_marca' => 'Sin datos'], 'total' => 0]
            ]);
        }

        // =============================================
        // ESTADÍSTICAS DE VENTAS
        // =============================================
        $stats_ventas = [
            'hoy' => Venta::whereDate('created_at', Carbon::today())->sum('total') ?? 0,
            'mes' => Venta::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total') ?? 0,
            'año' => Venta::whereYear('created_at', Carbon::now()->year)->sum('total') ?? 0,
            'total_ventas' => Venta::count(),
        ];

        // Ventas por mes (últimos 6 meses) - ORIGINAL
        $ventas_mensuales = Venta::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
            DB::raw('COALESCE(SUM(total), 0) as total_mes'),
            DB::raw('COUNT(*) as numero_ventas')
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        // Formatear meses para el gráfico
        $ventas_mensuales_formateadas = $ventas_mensuales->map(function ($item) {
            $date = Carbon::createFromFormat('Y-m', $item->mes);
            return (object) [
                'mes' => $date->format('M Y'),
                'total_mes' => $item->total_mes,
                'numero_ventas' => $item->numero_ventas
            ];
        });

        // Completar meses faltantes
        if ($ventas_mensuales_formateadas->count() < 6) {
            $allMonths = collect();
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $monthKey = $month->format('M Y');

                $existing = $ventas_mensuales_formateadas->first(function ($item) use ($monthKey) {
                    return $item->mes === $monthKey;
                });

                if (!$existing) {
                    $allMonths->push((object) [
                        'mes' => $monthKey,
                        'total_mes' => 0,
                        'numero_ventas' => 0
                    ]);
                } else {
                    $allMonths->push($existing);
                }
            }
            $ventas_mensuales_formateadas = $allMonths;
        }

        // =============================================
        // CRECIMIENTO DE CLIENTES (últimos 6 meses)
        // =============================================
        $clientes_mensuales = User::role('client')
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'),
                DB::raw('COUNT(*) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        // Formatear meses para el gráfico
        $clientes_mensuales_formateados = $clientes_mensuales->map(function ($item) {
            $date = Carbon::createFromFormat('Y-m', $item->mes);
            return (object) [
                'mes' => $date->format('M Y'),
                'total' => $item->total
            ];
        });

        // Completar meses faltantes
        if ($clientes_mensuales_formateados->count() < 6) {
            $allMonths = collect();
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $monthKey = $month->format('M Y');

                $existing = $clientes_mensuales_formateados->first(function ($item) use ($monthKey) {
                    return $item->mes === $monthKey;
                });

                if (!$existing) {
                    $allMonths->push((object) [
                        'mes' => $monthKey,
                        'total' => 0
                    ]);
                } else {
                    $allMonths->push($existing);
                }
            }
            $clientes_mensuales_formateados = $allMonths;
        }

        // =============================================
        // MODELOS DE VEHÍCULOS MÁS FRECUENTES (EXTRA)
        // =============================================
        $modelos_populares = vehiculos::select('model_vehicle', DB::raw('COUNT(*) as total'))
            ->whereNotNull('model_vehicle')
            ->groupBy('model_vehicle')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // =============================================
        // COLORES DE VEHÍCULOS MÁS FRECUENTES (EXTRA)
        // =============================================
        $colores_populares = vehiculos::select('color', DB::raw('COUNT(*) as total'))
            ->whereNotNull('color')
            ->groupBy('color')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // PARA TU VISTA ACTUAL, USAR LAS VARIABLES FORMATEADAS PERO CON LOS NOMBRES ORIGINALES
        $ventas_mensuales = $ventas_mensuales_formateadas;
        $clientes_mensuales = $clientes_mensuales_formateados;

        return view('layouts.dashboards.dashboardAdmin', compact(
            'stats_clientes',
            'stats_usuarios',
            'stats_productos',
            'stats_servicios',
            'stats_vehiculos',
            'stats_ventas',
            'marcas_populares',
            'ventas_mensuales',  // Ahora contiene los datos formateados
            'clientes_mensuales', // Ahora contiene los datos formateados
            'modelos_populares',
            'colores_populares'
        ));
    }

    /**
     * Dashboard para clientes - COMENTADO TEMPORALMENTE
     */
    /*
    public function cliente()
    {
        // Verificar que solo los clientes puedan ver este dashboard
        if (!auth()->user()->hasRole('client')) {
            return $this->redirectByRole();
        }

        $user = auth()->user();

        // Obtener ventas del cliente (usando la relación compras)
        // NOTA: Asegúrate de que el modelo User tenga el método compras()
        $mis_ventas = $user->compras()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Si no tienes la relación compras, usa esto:
        // $mis_ventas = ventas::where('cliente_id', $user->id)
        //     ->orderBy('created_at', 'desc')
        //     ->take(5)
        //     ->get();

        // Obtener vehículos del cliente
        $mis_vehiculos = vehiculos::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Estadísticas del cliente
        $stats_cliente = [
            'total_vehiculos' => vehiculos::where('user_id', $user->id)->count(),
            'total_compras' => $user->compras()->count(), // o ventas::where('cliente_id', $user->id)->count()
            'gasto_total' => $user->compras()->sum('total') ?? 0,
            'ultima_visita' => $user->updated_at->format('d/m/Y'),
        ];

        return view('dashboardCliente', compact(
            'mis_vehiculos',
            'mis_ventas',
            'stats_cliente'
        ));
    }
    */

    /**
     * Dashboard para empleados
     */
    public function empleado()
    {
        // Verificar que solo empleados puedan ver este dashboard
        $user = auth()->user();
        if (!$user->hasRole('user') && !$user->hasRole('empleado') && !$user->hasRole('admin')) {
            return $this->redirectByRole();
        }

        // =============================================
        // ESTADÍSTICAS PARA EMPLEADOS
        // =============================================

        // Ventas del empleado (usando ventasRealizadas)
        // NOTA: Asegúrate de que el modelo User tenga el método ventasRealizadas()
        $stats_empleado = [
            'ventas_hoy' => $user->ventasRealizadas()
                ->whereDate('created_at', Carbon::today())
                ->count(),
            'ventas_mes' => $user->ventasRealizadas()
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
            'total_ventas' => $user->ventasRealizadas()->count(),
            'productos_stock_bajo' => Productos::where('stock', '<', 10)->count(),
        ];
        
        // Ventas recientes realizadas por este empleado
        $mis_ventas_realizadas = $user->ventasRealizadas()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Productos con bajo stock
        $productos_bajo_stock = Productos::where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->take(10)
            ->get();

        return view('layouts.dashboards.dashboardEmpleado', compact(
            'stats_empleado',
            'mis_ventas_realizadas',
            'productos_bajo_stock'
        ));
    }

    /**
     * Cuando un empleado crea una venta:
     */
    /*
    public function crearVenta()
    {
        $user = auth()->user();

        // Solo empleados pueden crear ventas
        if (!$user->hasRole('user') && !$user->hasRole('empleado') && !$user->hasRole('admin')) {
            abort(403, 'No autorizado');
        }

        // Crear la venta asignando automáticamente el empleado
        $venta = ventas::create([
            'cliente_id' => request('cliente_id'), // Puede ser NULL
            'empleado_id' => $user->id, // SIEMPRE el usuario actual
            'product' => request('product'),
            'service' => request('service'),
            'description' => request('description'),
            'total' => request('total'),
            'fecha_venta' => request('fecha_venta') ?? now(),
            'detalles' => request('detalles'),
        ]);

        return redirect()->route('ventas.show', $venta->id)
            ->with('success', 'Venta creada exitosamente');
    }
    */

    // =============================================
    // Método para obtener datos en tiempo real (AJAX)
    // SOLO PARA ADMIN
    // =============================================
    public function getRealtimeStats()
    {
        // Verificar que sea admin
        if (!auth()->user()->hasRole('admin')) {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        return response()->json([
            'ventas_hoy' => Venta::whereDate('created_at', Carbon::today())->sum('total') ?? 0,
            'clientes_nuevos_hoy' => User::role('client')
                ->whereDate('created_at', Carbon::today())
                ->count(),
            'vehiculos_ingresados_hoy' => vehiculos::whereDate('created_at', Carbon::today())->count(),
            'servicios_hoy' => 0,
        ]);
    }
}