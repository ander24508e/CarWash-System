@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>EDITAR USUARIO</h1>
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
                    <label for="password" class="col-sm-2 col-form-label">Nueva Contraseña:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-warning p-2 mb-0">
                            <small>Dejar en blanco para no cambiar</small>
                        </div>
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
                                <option value="{{ $role->name }}" 
                                    {{ old('rol', $usuario->roles->first()->name ?? '') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Rol actual: <strong>{{ $usuario->roles->first()->name ?? 'Sin rol' }}</strong></small>
                        </div>
                    </div>
                    @error('rol')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Información adicional --}}
                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Información del Usuario</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>ID:</strong> {{ $usuario->id }}</p>
                                        <p><strong>Creado:</strong> {{ $usuario->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Última actualización:</strong> {{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">ACTUALIZAR</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection