@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-person-plus me-2"></i>AGREGAR CLIENTE
            </h5>
        </div>
        
        <div class="card-body">
            <form method="post" action="{{ route('clientes.store') }}">
                @csrf

                {{-- Mensajes de error --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="nameCustomer"
                            value="{{ old('nameCustomer') }}" placeholder="Ej: Juan" required>
                    </div>
                    @error('nameCustomer')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="lastname" class="col-sm-2 col-form-label">Apellido:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="lastname" name="lastnameCustomer"
                            value="{{ old('lastnameCustomer') }}" placeholder="Ej: Pérez" required>
                    </div>
                    @error('lastnameCustomer')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="identification" class="col-sm-2 col-form-label">Cédula:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="identification" name="identification"
                            pattern="\d{10}" maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            placeholder="1234567890"
                            title="Ingrese exactamente 10 dígitos numéricos"
                            value="{{ old('identification') }}" required>
                    </div>
                    @error('identification')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="cliente@ejemplo.com" required>
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-sm-2 col-form-label">Teléfono:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="phone" name="phone"
                            pattern="\d{10}" maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                            placeholder="0987654321"
                            title="Ingrese exactamente 10 dígitos numéricos"
                            value="{{ old('phone') }}" required>
                    </div>
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="address" class="col-sm-2 col-form-label">Dirección:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ old('address') }}" placeholder="Calle Principal #123">
                    </div>
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card-footer text-muted d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-check-circle me-2"></i>AGREGAR
                    </button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-dark" style="margin-left: 10px;">
                        <i class="bi bi-arrow-left me-2"></i>VOLVER
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection