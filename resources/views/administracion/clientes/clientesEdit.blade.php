@extends('menu')
@section('contenido')
    @vite(['resources/scss/allStyles.scss'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>EDITAR CLIENTE:
                </h5>
            </div>

            {{-- Información adicional --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light px-4 py-3">
                            <h6 class="mb-0 fw-semibold">Información del Cliente</h6>
                        </div>

                        <div class="card-body px-4 py-4">
                            <div class="row gy-2">
                                <div class="col-md-6">
                                    <p class="mb-0">
                                        <strong>Registrado:</strong>
                                        {{ $clientes->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>

                                <div class="col-md-6">
                                    <p class="mb-0">
                                        <strong>Última actualización:</strong>
                                        {{ $clientes->updated_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="card-body">
                <form method="post" action="{{ route('clientes.update', $clientes->id) }}">
                    @csrf
                    @method('PUT')

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

                    <div class="mb-3 row">
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

                    <div class="mb-3 row">
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

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" id="email" name="email">
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

                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-2 col-form-label">Teléfono:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="phone" name="phone" pattern="\d{10}" maxlength="10"
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

                    <div class="mb-3 row">
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
                    <div class="card-footer text-muted d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark">
                            <i class="bi bi-check-circle me-2"></i>ACTUALIZAR
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