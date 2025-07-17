@extends('menu')
@section('contenido')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>AGREGAR CATEGORIA</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('categorias.store') }}">
                @csrf
                @method('POST')

                <div class="mb-3 row">
                    <label for="categoria" class="col-sm-2 col-form-label">Categoria:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="categoria" name="nameCategory"
                            value="{{ old('nameCategory', $categorias->nameCategory ?? '') }}">
                    </div>
                    @error('nameCategory')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">AGREGAR</button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection