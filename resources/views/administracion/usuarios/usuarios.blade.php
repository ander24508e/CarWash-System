@extends('menu')
@section('contenido')
    @vite(['resources/scss/allStyles.scss'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    {{-- ✅ Barra de búsqueda CON FILTRO --}}
    <form class="d-flex buscar" action="{{ route('usuarios.index') }}" method="GET">
        <input class="form-control me-2" type="search" placeholder="Buscar Usuarios" name="search"
            value="{{ request('search') }}" style="max-width: 300px;">
        
        {{-- ✅ FILTRO DE ROLES (NUEVO) --}}
        <select class="form-select me-2" name="rol" style="max-width: 150px;">
            <option value="todos" {{ request('rol') == 'todos' || !request('rol') ? 'selected' : '' }}>
                Todos
            </option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ request('rol') == $role->name ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
        
        <button class="btn btn-outline-success buscar" type="submit">Buscar</button>
    </form>

    {{-- Botón Crear --}}
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary agregar">
        <i class="bi bi-plus-lg"></i> 
    </a>

    {{-- Mensajes de éxito/error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-4 mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container py-4">
        {{-- Tabla de usuarios --}}
        <div class="card shadow">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">USUARIOS</h5>
                {{-- ✅ Mostrar filtro activo (NUEVO) --}}
                @if(request('rol') && request('rol') != 'todos')
                <span class="badge bg-primary">Filtrado: {{ ucfirst(request('rol')) }}</span>
                @endif
            </div>
            <div class="card-body p-0">
                <table id="usuarios-table" class="table table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Fecha Creación</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @foreach($usuario->roles as $role)
                                        <span class="badge 
                                            @if($role->name == 'admin') bg-danger
                                            @elseif($role->name == 'user') bg-primary
                                            @else bg-success @endif">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-circle">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('usuarios.delete', $usuario->id) }}" 
                                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"
                                                {{ auth()->id() == $usuario->id ? 'disabled' : '' }}>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted">No se encontraron usuarios.</p>
                                    @if(request('search') || request('rol'))
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary">
                                        Ver todos
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $usuarios->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        {{-- Botón volver --}}
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Volver al menú
            </a>
        </div>
    </div>
@endsection