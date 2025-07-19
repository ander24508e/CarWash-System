@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<form class="d-flex buscar" action="{{ route('marcas.buscar') }}" method="GET">
    @csrf
    <input class="form-control me-2" type="search" placeholder="Buscar Marcas" name="searchTerm"
        value="{{ request()->searchTerm }}">
    <button class="btn btn-outline-success buscar" type="submit">Buscar</button>
</form>

{{-- Crear  --}}
<a href="{{ route('marcas.create') }}" class="btn btn-primary agregar">
    <i class="bi bi-plus-lg"></i>
</a>

@if ($marcas_buscar->count() == 0)
<div class="alert alert-info mt-3">
    No se encontraron marcas con el término: "{{ request()->searchTerm }}"
</div>
@else
<div class="container py-4">
    <!-- Tabla de marcas -->
    <div class="card shadow">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Marcas</h5>
        </div>
        <div class="card-body p-0">
            <table id="vehiculos-table" class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Marca</th>
                        <th>Imagen</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marcas_buscar as $marca)
                    <tr>
                        <td>{{ $marca->id }}</td>
                        <td>{{ $marca->placa }}</td>
                        <td>{{ $marca->image }}</td>
                        <td>
                            <a href="{{ route('marcas.edit', ['marcas_edit' => $marca->id]) }}"
                                class="btn btn-sm btn-outline-primary rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                        <td>
                            <form method="POST"
                                action="{{ route('marcas.delete', ['marcas_eliminar' => $marca->id]) }}">
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
        </div>
    </div>
    <!-- Botón volver -->
    <div class="text-center mt-4">
        <a href="{{ route('menu') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Volver al menú
        </a>
    </div>
</div>
@endif
@endsection