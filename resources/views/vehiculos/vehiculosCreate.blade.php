@extends('menu')
@section('contenido')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                <h1>AGREGAR VEHICULO</h1>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('vehiculos.store') }}">
                    @csrf
                    @method('POST')

                    <div class="mb-3 row">
                        <label for="nameCustomer" class="col-sm-2 col-form-label">Propietario</label>
                        <div class="col-sm-4">
                            <select id="nameCustomer" name="nameCustomer" class="form-control">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->lastname_customer }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="placa" class="col-sm-2 col-form-label">Placa del Vehiculo:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="placa" name="numberPlaca"
                                value="{{ old('numberPlaca', $categorias->numberPlaca ?? '') }}">
                        </div>
                        @error('numberPlaca')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="brand" class="col-sm-2 col-form-label">Marca del Vehiculo:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="brand" name="brandVehicle"
                                value="{{ old('brandVehicle', $categorias->brandVehicle ?? '') }}">
                        </div>
                        @error('brandVehicle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="model" class="col-sm-2 col-form-label">Modelo del Vehiculo:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="model" name="modelVehicle"
                                value="{{ old('modelVehicle', $categorias->modelVehicle ?? '') }}">
                        </div>
                        @error('modelVehicle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="color" class="col-sm-2 col-form-label">Color del Vehiculo:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="color" name="color"
                                value="{{ old('color', $categorias->color ?? '') }}">
                        </div>
                        @error('color')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="card-footer text-muted">
                        <button type="submit" class="btn btn-dark">AGREGAR</button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-dark"
                            style="margin-left: 10px;">VOLVER</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
