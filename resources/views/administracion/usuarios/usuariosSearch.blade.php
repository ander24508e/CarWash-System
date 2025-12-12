@extends('menu')
@section('contenido')
    @vite(['resources/scss/allStyles.scss'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    {{-- Barra de búsqueda --}}
    <form class="d-flex buscar" action="{{ route('usuarios.buscar') }}" method="GET">
        @csrf
        <input class="form-control me-2" type="search" placeholder="Buscar Usuarios" name="searchTerm"
            value="{{ request()->searchTerm }}">
        <button class="btn btn-outline-success buscar" type="submit">Buscar</button>
    </form>

    {{-- Botón Crear --}}
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary agregar">
        <i class="bi bi-plus-lg"></i>
    </a>

    <div class="container py-4">
        @if($usuarios_buscar->count() == 0)
            {{-- No hay resultados --}}
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                No se encontraron usuarios con el término: "{{ request()->searchTerm }}"
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Volver a todos los usuarios
                </a>
            </div>
        @else
            {{-- Resultados --}}
            <div class="card shadow">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">RESULTADOS DE BÚSQUEDA</h5>
                    <span class="badge bg-primary">Encontrados: {{ $usuarios_buscar->total() }}</span>
                </div>
                
                <div class="card-body p-0">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios_buscar as $usuario)
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
                                    <td>
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" 
                                           class="btn btn-sm btn-outline-primary rounded-circle">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('usuarios.delete', $usuario->id) }}" 
                                              onsubmit="return confirm('¿Eliminar usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle"
                                                    {{ auth()->id() == $usuario->id ? 'disabled' : '' }}>
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center mt-3">
                        {{ $usuarios_buscar->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
            
            {{-- Botón volver --}}
            <div class="text-center mt-4">
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver al menú
                </a>
            </div>
        @endif
    </div>
@endsection