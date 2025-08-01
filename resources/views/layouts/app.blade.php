<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavadora Endara</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <!-- Logo y menú Productos en línea -->
                <a class="navbar-brand me-3" href="menu">
                    <img src="{{ asset('Images/lavadora-logo.jpg') }}" class="logo">
                </a>

                <!-- Menú de Productos alineado con el logo
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-box-seam me-2"></i>Vehiculos
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            {{-- Contenido aqui menu  --}}
                        </ul>
                    </li>
                </ul> -->
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <a class="navbar-brand">
                        <img src="{{ asset('Images/lavadora-logo.jpg') }}" class="logo">
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                @auth
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-box-seam me-2"></i>Inventario
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/productos"><i class="bi bi-list-check me-2"></i>
                                        Productos</a></li>
                                <li><a class="dropdown-item" href="/ver-categorias"><i
                                            class="bi bi-list-check me-2"></i>
                                        Categorias</a></li>
                                <li><a class="dropdown-item" href="/servicios"><i class="bi bi-list-check me-2"></i>
                                        Servicios</a></li>
                            </ul>
                        </li>

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-people me-2"></i>Contabilidad
                                </a>
                                <ul class="dropdown-menu">
                                    <li> <a class="dropdown-item" role="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-receipt me-2"></i>Facturas
                                        </a></li>
                                    <li><a class="dropdown-item" href="/ventas"><i class="bi bi-list-check me-2"></i>Ventas</a></li>
                                    <li><a class="dropdown-item" href="/clientes"><i
                                                class="bi bi-list-check me-2"></i>Clientes</a></li>
                                    <li> <a class="dropdown-item" role="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-person-lines-fill me-2"></i>Empleados
                                        </a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-people me-2"></i>Vehiculos
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/vehiculos"><i
                                                class="bi bi-list-check me-2"></i> Vehiculos</a></li>
                                    <li><a class="dropdown-item" href="/marcas-vehiculos"><i class="bi bi-list-check me-2"></i>Marcas</a></li>

                                    <li><a class="dropdown-item" href="/modelos-vehiculos"><i class="bi bi-list-check me-2"></i>Modelos</a></li>
                                </ul>
                            </li>
                        </ul>
                    </ul>

                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">
                            <i class="bi bi-person-lines-fill me-2"></i>Configuración
                        </a>
                    </li>
                </ul>

                <div class="logout-footer">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-box-arrow-left me-2"></i>Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </nav>
    <main class="container py-4" style="margin-top: 80px;">
        @yield('contenido')
    </main>

</body>

</html>