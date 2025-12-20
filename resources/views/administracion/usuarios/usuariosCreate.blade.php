@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="bi bi-person-plus me-2"></i>AGREGAR USUARIO
            </h5>
        </div>
        
        <div class="card-body">
            <form method="post" action="{{ route('usuarios.store') }}">
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
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}" placeholder="Ej: Juan Pérez" required>
                    </div>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="Ej: usuario@ejemplo.com" required>
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmar Contraseña:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password_confirmation" 
                               name="password_confirmation" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="rol" class="col-sm-2 col-form-label">Rol:</label>
                    <div class="col-sm-4">
                        <select id="rol" name="rol" class="form-select" required>
                            <option value="">Seleccionar rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" 
                                        {{ old('rol') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('rol')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card-footer text-muted d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-check-circle me-2"></i>AGREGAR
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