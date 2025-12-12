@extends('menu')
@section('contenido')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>EDITAR CLIENTE: {{ $clientes->name_customer ?? 'Nuevo Cliente' }}</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ isset($clientes) ? route('clientes.update', $clientes->id) : route('clientes.store') }}">
                @csrf
                @method(isset($clientes) ? 'PUT' : 'POST')

                <!-- Campo Nombre -->
                <div class="mb-3 row align-items-center">
                    <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="name_customer">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $clientes->name_customer ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('name_customer')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Apellido -->
                <div class="mb-3 row align-items-center">
                    <label for="lastname" class="col-sm-2 col-form-label">Apellido:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="lastname" name="lastnameCustomer">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $clientes->lastname_customer ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('lastnameCustomer')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Cédula -->
                <div class="mb-3 row align-items-center">
                    <label for="identification" class="col-sm-2 col-form-label">Cédula:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="identification" name="identification"
                            pattern="\d{10}" maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            title="Ingrese exactamente 10 dígitos numéricos">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $clientes->identification ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('identification')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Email -->
                <div class="mb-3 row align-items-center">
                    <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $clientes->email ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Teléfono -->
                <div class="mb-3 row align-items-center">
                    <label for="phone" class="col-sm-2 col-form-label">Teléfono:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="phone" name="phone"
                            pattern="\d{10}" maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            title="Ingrese exactamente 10 dígitos numéricos">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $clientes->phone ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Campo Dirección -->
                <div class="mb-3 row align-items-center">
                    <label for="address" class="col-sm-2 col-form-label">Dirección:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $clientes->address ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">{{ isset($clientes) ? 'ACTUALIZAR' : 'AGREGAR' }}</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection