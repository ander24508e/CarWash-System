@extends('menu')
@section('contenido')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <h1>EDITAR MODELO</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('modelos.update', ['modelos_id' => $modelos->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 row">
                        <label for="marca" class="col-sm-2 col-form-label">Marca del Vehiculo:</label>
                        <div class="col-sm-4">
                            <select id="nameMarca" name="nameMarca" class="form-control">
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">
                                        {{ $marca->name_brand }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="modelo" class="col-sm-2 col-form-label">Modelo:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="modelo" name="nameModel">
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info p-2 mb-0">
                                <small>Dato actual: <strong>{{ $modelos->modelo ?? 'N/A' }}</strong></small>
                            </div>
                        </div>
                        @error('nameModel')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-dark">AGREGAR</button>
                        <a href="{{ route('modelos.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
