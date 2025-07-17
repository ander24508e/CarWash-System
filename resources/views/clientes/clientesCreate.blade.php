@extends('menu')
@section('contenido')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>AGREGAR CLIENTES</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('clientes.store') }}">
                @csrf
                @method('POST')

                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="nameCustomer"
                            value="{{ old('nameCustomer', $clientes->nameCustomer ?? '') }}">
                    </div>
                    @error('nameCustomer')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="lastname" class="col-sm-2 col-form-label">Apellido:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="lastname" name="lastnameCustomer"
                            value="{{ old('lastnameCustomer', $clientes->lastnameCustomer ?? '') }}">
                    </div>
                    @error('lastnameCustomer')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="identification" class="col-sm-2 col-form-label">Cédula:</label>
                    <div class="col-sm-4">
                        <input type="text"
                            class="form-control"
                            id="identification"
                            name="identification"
                            pattern="\d{10}"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            title="Ingrese exactamente 10 dígitos numéricos"
                            value="{{ old('identification', $clientes->identification ?? '') }}"
                            required>
                        @error('identification')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ old('email', $clientes->email ?? '') }}">
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-sm-2 col-form-label">Telefono:</label>
                    <div class="col-sm-4">
                        <input type="text"
                            class="form-control"
                            id="phone"
                            name="phone"
                            pattern="\d{10}"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            title="Ingrese exactamente 10 dígitos numéricos"
                            value="{{ old('phone', $clientes->phone ?? '') }}"
                            required>
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="address" class="col-sm-2 col-form-label">Dirección:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address', $clientes->address ?? '') }}">
                    </div>
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">AGREGAR</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection