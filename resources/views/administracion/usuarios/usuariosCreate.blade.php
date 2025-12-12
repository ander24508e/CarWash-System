@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>AGREGAR USUARIO</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('usuarios.store') }}">
                @csrf
                @method('POST')

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
                            value="{{ old('name') }}" placeholder="Ej: Juan Pérez">
                    </div>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}" placeholder="Ej: usuario@ejemplo.com">
                    </div>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
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
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="rol" class="col-sm-2 col-form-label">Rol:</label>
                    <div class="col-sm-4">
                        <select id="rol" name="rol" class="form-control">
                            <option value="">Seleccionar rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('rol') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">AGREGAR</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection