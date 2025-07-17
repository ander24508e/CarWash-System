@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<form class="d-flex buscar" action="{{ route('vehiculos.buscar') }}" method="GET">
    @csrf
    <input class="form-control me-2" type="search" placeholder="Buscar Vehiculos" name="searchTerm"
        value="{{ request()->searchTerm }}">
    <button class="btn btn-outline-success buscar" type="submit">Buscar</button>
</form>

{{-- Crear  --}}
<a href="{{ route('vehiculos.create') }}" class="btn btn-primary agregar">
    <i class="bi bi-plus-lg"></i>
</a>

<div class="container py-4">
    <!-- Tabla de vehículos -->
    <div class="card shadow">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Vehiculos</h5>
        </div>
        <div class="card-body p-0">
            <table id="vehiculos-table" class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Placa</th>
                        <th>Cliente</th>
                        <th>Marca Vehiculo</th>
                        <th>Modelo de Vehiculo</th>
                        <th>Color del Vehiculo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->id }}</td>
                        <td>{{ $vehiculo->placa }}</td>
                        <td>{{ $vehiculo->customer }}</td>
                        <td>{{ $vehiculo->brand_vehicle }}</td>
                        <td>{{ $vehiculo->model_vehicle}}</td>
                        <td>{{ $vehiculo->color }}</td>
                        <td>
                            <a href="{{ route('vehiculos.edit', ['vehiculos_edit' => $vehiculo->id]) }}"
                                class="btn btn-sm btn-outline-primary rounded-circle">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                        <td>
                            <form method="POST"
                                action="{{ route('vehiculos.delete', ['vehiculos_eliminar' => $vehiculo->id]) }}">
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
@endsection