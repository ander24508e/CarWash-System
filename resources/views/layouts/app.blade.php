<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavadora Endara</title>
    @vite(['resources/scss/allStyles.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <!-- Navbar profesional -->
    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
        <div class="container-fluid">
            <!-- Logo y marca a la izquierda -->
            <a class="navbar-brand d-flex align-items-center me-4" href="/menu">
                @auth
                    @if(Auth::user()->empresa && Auth::user()->empresa->logo)
                        <img src="{{ Auth::user()->empresa->logo_url }}" class="navbar-logo me-2"
                            alt="{{ Auth::user()->empresa->nombre }}">
                    @else
                        <img src="{{ asset('Images/lavadora-logo.jpg') }}" class="navbar-logo me-2" alt="CarWash System">
                    @endif
                @else
                    <img src="{{ asset('Images/lavadora-logo.jpg') }}" class="navbar-logo me-2" alt="CarWash System">
                @endauth

                <div class="brand-text">
                    <h5 class="mb-0 brand-title">
                        @auth
                            {{ Auth::user()->empresa->nombre ?? 'CarWash System' }}
                        @else
                            CarWash System
                        @endauth
                    </h5>
                    <small class="brand-subtitle">desde 1978</small>
                </div>
            </a>

            <!-- Menú de navegación principal -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    <!-- Menú Contabilidad -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-calculator me-1"></i>
                            Contabilidad
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">
                                    <i class="bi bi-receipt me-2"></i>Facturas
                                </a></li>
                            <li><a class="dropdown-item" href="/ventas">
                                    <i class="bi bi-currency-dollar me-2"></i>Ventas
                                </a></li>
                            <li><a class="dropdown-item" href="/clientes">
                                    <i class="bi bi-people me-2"></i>Clientes
                                </a></li>
                            <li><a class="dropdown-item" href="#">
                                    <i class="bi bi-person-badge me-2"></i>Empleados
                                </a></li>
                        </ul>
                    </li>

                    <!-- Menú Vehículos -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-truck me-1"></i>
                            Vehículos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/vehiculos">
                                    <i class="bi bi-car-front me-2"></i>Vehículos
                                </a></li>
                            <li><a class="dropdown-item" href="/marcas-vehiculos">
                                    <i class="bi bi-tags me-2"></i>Marcas
                                </a></li>
                            <li><a class="dropdown-item" href="/modelos-vehiculos">
                                    <i class="bi bi-gear me-2"></i>Modelos
                                </a></li>
                        </ul>
                    </li>

                    <!-- Menú Inventario -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-box-seam me-1"></i>
                            Inventario
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/productos">
                                    <i class="bi bi-box me-2"></i>Productos
                                </a></li>
                            <li><a class="dropdown-item" href="/ver-categorias">
                                    <i class="bi bi-diagram-3 me-2"></i>Categorías
                                </a></li>
                            <li><a class="dropdown-item" href="/servicios">
                                    <i class="bi bi-tools me-2"></i>Servicios
                                </a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Menú usuario a la derecha -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-menu" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            Mi Cuenta
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/empresa">
                                    <i class="bi bi-gear me-2"></i>Empresa
                                </a></li>
                            <li><a class="dropdown-item" href="/profile">
                                    <i class="bi bi-gear me-2"></i>Perfil
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-left me-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Botón hamburguesa para móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container-fluid py-4">
            @yield('contenido')

            <!-- Ejemplo de tarjetas (esto iría en tu contenido)
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-body">
                            <h5 class="card-title">Ventas del Día</h5>
                            <p class="card-text">Resumen de ventas y servicios realizados hoy.</p>
                            <a href="#" class="btn btn-primary">Ver Reporte</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-body">
                            <h5 class="card-title">Clientes Activos</h5>
                            <p class="card-text">Gestión de clientes y vehículos registrados.</p>
                            <a href="#" class="btn btn-primary">Administrar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-body">
                            <h5 class="card-title">Inventario</h5>
                            <p class="card-text">Control de productos y servicios disponibles.</p>
                            <a href="#" class="btn btn-primary">Revisar</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </main>
</body>

</html>