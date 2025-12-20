@extends('menu')
@section('contenido')
    @vite(['resources/scss/allStyles.scss'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>EDITAR USUARIO
                </h5>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('usuarios.update', $usuario->id) }}">
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
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info p-2 mb-0">
                                <small>Valor actual: <strong>{{ $usuario->name ?? 'N/A' }}</strong></small>
                            </div>
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info p-2 mb-0">
                                <small>Valor actual: <strong>{{ $usuario->email ?? 'N/A' }}</strong></small>
                            </div>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="rol" class="col-sm-2 col-form-label">Rol:</label>
                        <div class="col-sm-4">
                            <select id="rol" name="rol" class="form-select" required>
                                <option value="">Seleccionar rol</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('rol', $usuario->roles->first()->name ?? '') == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="alert alert-info p-2 mb-0">
                                <small>Rol actual:
                                    <strong>{{ $usuario->roles->first()->name ?? 'Sin rol' }}</strong></small>
                            </div>
                        </div>
                        @error('rol')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Nueva Contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar Contraseña:</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                        </div>
                    </div>


                    <div class="card-footer text-muted d-flex justify-content-center">
                        <button type="submit" class="btn btn-dark">
                            <i class="bi bi-check-circle me-2"></i>ACTUALIZAR
                        </button>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-dark" style="margin-left: 10px;">
                            <i class="bi bi-arrow-left me-2"></i>VOLVER
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection