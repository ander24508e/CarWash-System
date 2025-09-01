@extends('menu')
@section('contenido')
    @vite(['resources/scss/allStyles.scss'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <form class="d-flex buscar" action="{{ route('categorias.buscar') }}" method="GET">
        @csrf
        <input class="form-control me-2" type="search" placeholder="Buscar Categorias" name="searchTerm"
            value="{{ request()->searchTerm }}">
        <button class="btn btn-outline-success buscar" type="submit">Buscar</button>
    </form>

    {{-- Crear  --}}
    <a href="{{ route('categorias.create') }}" class="btn btn-primary agregar">
        <i class="bi bi-plus-lg"></i>
    </a>

    <div class="container py-4">
        <!-- Tabla de categorías -->
        <div class="card shadow">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">CATEGORÍAS</h5>
            </div>
            <div class="card-body p-0">
                <table id="categorias-table" class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Categoría</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->name_category }}</td>
                                <td>
                                    <a href="{{ route('categorias.edit', ['categorias_edit' => $categoria->id]) }}"
                                        class="btn btn-sm btn-outline-primary rounded-circle">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                                <td>
                                    <form method="POST"
                                        action="{{ route('categorias.delete', ['categorias_eliminar' => $categoria->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {{ $categorias->links('pagination::bootstrap-4') }}
                </div>

                {{-- <div class="d-flex justify-content-center mt-4 px-4">
                    {{ $categorias->links() }}
                </div> --}}
                
            </div>
        </div>
        <!-- Botón volver -->
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Volver al menú
            </a>
        </div>
    </div>
@endsection
