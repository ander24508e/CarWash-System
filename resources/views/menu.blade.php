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
            <a class="navbar-brand" href="menu">
                <img src="{{ asset('Images/lavadora-logo.jpg') }}" class="logo">
                <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-box-seam me-2"></i>Productos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/productos"><i class="bi bi-list-check me-2"></i>Ver
                                        Productos</a></li>
                                <li><a class="dropdown-item" href="/agregar-productos"><i
                                            class="bi bi-plus-circle me-2"></i>Agregar Productos</a></li>
                            </ul>
                        </li>
                </ul>

            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>



            {{-- Menu Lateral con opciones --}}
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <a class="navbar-brand" href="/profile">
                        <img src="{{ asset('Images/lavadora-logo.jpg') }}" class="logo">
                    </a>
                    <h5 class="mb-0">Anderson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-box-seam me-2"></i>Productos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/productos"><i class="bi bi-list-check me-2"></i>Ver
                                        Productos</a></li>
                                <li><a class="dropdown-item" href="/agregar-productos"><i
                                            class="bi bi-plus-circle me-2"></i>Agregar Productos</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-people me-2"></i>Clientes
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/clientes"><i class="bi bi-list-check me-2"></i>Ver
                                        Clientes</a></li>
                                <li><a class="dropdown-item" href="/agregar-clientes"><i
                                            class="bi bi-plus-circle me-2"></i>Agregar Clientes</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-tags me-2"></i>Categorias
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/ver-categorias"><i class="bi bi-list-check me-2"></i>Ver
                                        Categorias</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-cash-stack me-2"></i>Ventas
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/ventas"><i class="bi bi-list-check me-2"></i>Ver
                                        Ventas</a></li>
                                <li><a class="dropdown-item" href="/agregar-ventas"><i
                                            class="bi bi-plus-circle me-2"></i>Agregar Venta</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-receipt me-2"></i>Facturas
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/facturas"><i class="bi bi-list-check me-2"></i>Ver
                                        Facturas</a></li>
                                <li><a class="dropdown-item" href="/agregar-facturas"><i
                                            class="bi bi-plus-circle me-2"></i>Agregar Facturas</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-tools me-2"></i>Servicios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/servicios"><i class="bi bi-list-check me-2"></i>Ver
                                        Servicios</a></li>
                                <li><a class="dropdown-item" href="/agregar-servicios"><i
                                            class="bi bi-plus-circle me-2"></i>Agregar Servicio</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-truck me-2"></i>Vehículos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/vehiculos"><i
                                            class="bi bi-list-check me-2"></i>Ver Vehiculos</a></li>
                                <li><a class="dropdown-item" href="/agregar-vehiculos"><i
                                            class="bi bi-plus-circle me-2"></i>Agregar Vehiculo</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-lines-fill me-2"></i>Usuarios
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/usuarios"><i
                                            class="bi bi-list-check me-2"></i>Ver Usuarios</a></li>
                                <li><a class="dropdown-item" href="/empleados"><i
                                            class="bi bi-list-check me-2"></i>Ver Empleados</a></li>
                            </ul>
                        </li>

                        <li class="nav-item logout mt-4 pt-3 border-top">
                            <form method="POST" action="{{ route('logout') }}" class="w-100">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="bi bi-box-arrow-left me-2"></i>Cerrar Sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4" style="margin-top: 80px;">
        @yield('contenido')
    </main>

</body>

</html>