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
            @auth
                <a class="navbar-brand d-flex align-items-center me-4" href="{{ route('menu') }}">
                    <img src="{{ empresa_logo() }}" class="navbar-logo me-2" alt="{{ empresa_nombre() }}">

                    <div class="brand-text">
                        <h5 class="mb-0 brand-title">
                            {{ empresa_nombre() }}
                        </h5>
                    </div>
                </a>
            @endauth

            <!-- Menú de navegación principal -->
            @auth
                @php
                    // Verificar roles usando Spatie Permission
                    $user = auth()->user();
                    $isAdmin = $user->hasRole('admin');
                    $isUser = $user->hasRole('user');
                    // Si tienes clientes como un modelo separado, podrías verificar:
                    // $isCliente = $user->hasRole('cliente') o algún otro método
                @endphp

                <!-- SOLO mostrar menú si NO es cliente -->
                <!-- Si los clientes están en la tabla users con rol 'cliente', ajusta esto -->
                @if($isAdmin || $isUser)
                    <div class="collapse navbar-collapse" id="navbarMain">
                        <ul class="navbar-nav me-auto">
                            <!-- PARA ADMINISTRADORES: mostrar Miembros, Vehículos, Inventario -->
                            @if($isAdmin)
                                <!-- Menú Miembros -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-people me-1"></i>
                                        Miembros
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/clientes">
                                                <i class="bi bi-person me-2"></i>Clientes
                                            </a></li>
                                        <li><a class="dropdown-item" href="/usuarios">
                                                <i class="bi bi-person-badge me-2"></i>Usuarios
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
                                        <li><a class="dropdown-item" href="/servicios">
                                                <i class="bi bi-tools me-2"></i>Servicios
                                            </a></li>
                                        <li><a class="dropdown-item" href="/categorias">
                                                <i class="bi bi-diagram-3 me-2"></i>Categorías
                                            </a></li>
                                        <li><a class="dropdown-item" href="/productos">
                                                <i class="bi bi-box me-2"></i>Productos
                                            </a></li>
                                    </ul>
                                </li>
                            @endif

                            <!-- Menú Contabilidad (para admin y user/empleado) -->
                            @if($isAdmin || $isUser)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-calculator me-1"></i>
                                        Contabilidad
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- Facturas solo para admin -->
                                        @if($isAdmin)
                                            <li><a class="dropdown-item" href="#">
                                                    <i class="bi bi-receipt me-2"></i>Facturas
                                                </a></li>
                                        @endif

                                        <!-- Ventas para admin y user/empleado -->
                                        <li><a class="dropdown-item" href="/ventas">
                                                <i class="bi bi-currency-dollar me-2"></i>Ventas
                                            </a></li>

                                        <!-- Reportes solo para admin -->
                                        @if($isAdmin)
                                            <li><a class="dropdown-item" href="#">
                                                    <i class="bi bi-graph-up me-2"></i>Reportes
                                                </a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                @endif {{-- Fin del if($isAdmin || $isUser) --}}

                    <!-- Menú usuario a la derecha (para todos los autenticados) -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-menu" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>
                                Mi Cuenta
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <!-- Opción Empresa solo para admin -->
                                @if($isAdmin)
                                    <li><a class="dropdown-item" href="/empresa">
                                            <i class="bi bi-building me-2"></i>Empresa
                                        </a></li>
                                @endif

                                <!-- Perfil para todos -->
                                <li><a class="dropdown-item" href="/profile">
                                        <i class="bi bi-person me-2"></i>Perfil
                                    </a></li>

                                <!-- Si tienes clientes en la misma tabla con otro rol -->
                                @if(!$isAdmin && !$isUser)
                                    <!-- Opciones para clientes -->
                                    <li><a class="dropdown-item" href="/mis-vehiculos">
                                            <i class="bi bi-car-front me-2"></i>Mis Vehículos
                                        </a></li>
                                    <li><a class="dropdown-item" href="/mis-citas">
                                            <i class="bi bi-calendar me-2"></i>Mis Citas
                                        </a></li>
                                @endif

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
            @endauth
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container-fluid py-4">
            @yield('contenido')
        </div>
    </main>
</body>

</html>