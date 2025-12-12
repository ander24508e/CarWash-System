@extends('menu')
@section('contenido')
    @vite(['resources/scss/dashboardStyles.scss'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="dashboard-container container-fluid p-4">
        {{-- Título del Dashboard --}}
        <div class="dashboard-header">
            <h2><i class="bi bi-speedometer2"></i>Dashboard de Estadísticas</h2>
            <p>Resumen general del sistema CarWash</p>
        </div>

        {{-- ========================================== --}}
        {{-- TARJETAS DE ESTADÍSTICAS PRINCIPALES --}}
        {{-- ========================================== --}}
        <div class="dashboard-grid mb-4">
            {{-- Clientes --}}
            <div class="stats-card">
                <div class="card-body">
                    <div class="stats-content">
                        <div class="stats-text">
                            <span class="stats-label">Total Clientes</span>
                            <h3 class="stats-value">{{ $stats_clientes['total'] }}</h3>
                            <span class="stats-trend positive">
                                <i class="bi bi-arrow-up"></i> {{ $stats_clientes['nuevos_mes'] }} este mes
                            </span>
                        </div>
                        <div class="stats-icon clients-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ventas del Día --}}
            <div class="stats-card">
                <div class="card-body">
                    <div class="stats-content">
                        <div class="stats-text">
                            <span class="stats-label">Ventas Hoy</span>
                            <h3 class="stats-value">${{ number_format($stats_ventas['hoy'], 2) }}</h3>
                            <span class="stats-trend neutral">
                                {{ \Carbon\Carbon::today()->format('d/m/Y') }}
                            </span>
                        </div>
                        <div class="stats-icon sales-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Productos --}}
            <div class="stats-card">
                <div class="card-body">
                    <div class="stats-content">
                        <div class="stats-text">
                            <span class="stats-label">Productos</span>
                            <h3 class="stats-value">{{ $stats_productos['total'] }}</h3>
                            <span class="stats-trend negative">
                                <i class="bi bi-exclamation-triangle"></i> {{ $stats_productos['stock_bajo'] }} stock bajo
                            </span>
                        </div>
                        <div class="stats-icon products-icon">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Servicios --}}
            <div class="stats-card">
                <div class="card-body">
                    <div class="stats-content">
                        <div class="stats-text">
                            <span class="stats-label">Servicios Activos</span>
                            <h3 class="stats-value">{{ $stats_servicios['activos'] }}</h3>
                            <span class="stats-trend neutral">
                                de {{ $stats_servicios['total'] }} totales
                            </span>
                        </div>
                        <div class="stats-icon services-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- GRÁFICOS Y TABLAS --}}
        {{-- ========================================== --}}
        <div class="row g-4">
            {{-- Gráfico de Ventas Mensuales --}}
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="card-header">
                        <h5 class="sales-title"><i class="bi bi-graph-up"></i>Ventas de los Últimos 6 Meses</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="ventasChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Marcas de Vehículos Más Frecuentes --}}
            <div class="col-lg-4">
                <div class="chart-card">
                    <div class="card-header">
                        <h5 class="brands-title"><i class="bi bi-car-front"></i>Marcas Más Frecuentes</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="marcasChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- SEGUNDA FILA DE GRÁFICOS --}}
        {{-- ========================================== --}}
        <div class="row g-4 mt-4">
            {{-- Crecimiento de Clientes --}}
            <div class="col-lg-6">
                <div class="chart-card">
                    <div class="card-header">
                        <h5 class="clients-title"><i class="bi bi-people"></i>Crecimiento de Clientes</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="clientesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Distribución de Usuarios --}}
            <div class="col-lg-6">
                <div class="chart-card">
                    <div class="card-header">
                        <h5 class="users-title"><i class="bi bi-person-lines-fill"></i>Distribución de Usuarios</h5>
                    </div>
                    <div class="card-body">
                        <div class="users-distribution">
                            <div class="row text-center">
                                <div class="col-4 distribution-item">
                                    <div class="distribution-value admins-value">
                                        <h3>{{ $stats_usuarios['admins'] }}</h3>
                                    </div>
                                    <p class="distribution-label">Administradores</p>
                                </div>
                                <div class="col-4 distribution-item">
                                    <div class="distribution-value employees-value">
                                        <h3>{{ $stats_usuarios['empleados'] }}</h3>
                                    </div>
                                    <p class="distribution-label">Usuarios</p>
                                </div>
                                <div class="col-4 distribution-item">
                                    <div class="distribution-value clients-value">
                                        <h3>{{ $stats_usuarios['clientes'] }}</h3>
                                    </div>
                                    <p class="distribution-label">Clientes</p>
                                </div>
                            </div>
                            <hr>
                            <div class="chart-container">
                                <canvas id="usuariosChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- SCRIPTS DE CHART.JS --}}
    {{-- ========================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =============================================
            // GRÁFICO DE VENTAS MENSUALES
            // =============================================
            const ventasCtx = document.getElementById('ventasChart').getContext('2d');
            new Chart(ventasCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($ventas_mensuales->pluck('mes')) !!},
                    datasets: [{
                        label: 'Ventas ($)',
                        data: {!! json_encode($ventas_mensuales->pluck('total_mes')) !!},
                        borderColor: '#d82128',
                        backgroundColor: 'rgba(216, 33, 40, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });

            // =============================================
            // GRÁFICO DE MARCAS DE VEHÍCULOS
            // =============================================
            const marcasCtx = document.getElementById('marcasChart').getContext('2d');
            new Chart(marcasCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($marcas_populares->pluck('marca.nombre_marca')) !!},
                    datasets: [{
                        data: {!! json_encode($marcas_populares->pluck('total')) !!},
                        backgroundColor: [
                            '#d82128',
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#8b5cf6',
                            '#ec4899',
                            '#14b8a6',
                            '#f97316'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        }
                    }
                }
            });

            // =============================================
            // GRÁFICO DE CRECIMIENTO DE CLIENTES
            // =============================================
            const clientesCtx = document.getElementById('clientesChart').getContext('2d');
            new Chart(clientesCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($clientes_mensuales->pluck('mes')) !!},
                    datasets: [{
                        label: 'Nuevos Clientes',
                        data: {!! json_encode($clientes_mensuales->pluck('total')) !!},
                        backgroundColor: '#10b981',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // =============================================
            // GRÁFICO DE DISTRIBUCIÓN DE USUARIOS
            // =============================================
            const usuariosCtx = document.getElementById('usuariosChart').getContext('2d');
            new Chart(usuariosCtx, {
                type: 'pie',
                data: {
                    labels: ['Admins', 'Empleados', 'Clientes'],
                    datasets: [{
                        data: [
                            {{ $stats_usuarios['admins'] }},
                            {{ $stats_usuarios['empleados'] }},
                            {{ $stats_usuarios['clientes'] }}
                        ],
                        backgroundColor: ['#d82128', '#3b82f6', '#10b981'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection