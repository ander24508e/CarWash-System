@extends('menu')
@section('contenido')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>AGREGAR MARCA</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('marcas.update', ['marcas_id' => $marcas->id]) }}">
                @csrf
                @method('PUT')

                <div class="mb-3 row">
                    <label for="marca" class="col-sm-2 col-form-label">Marcas:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="marca" name="nameMarca">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->name_product ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('nameMarca')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="image" class="col-sm-2 col-form-label">Imagen:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="image" name="image"
                            value="{{ old('image', $marcas->image ?? '') }}">
                    </div>
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">AGREGAR</button>
                    <a href="{{ route('marcas.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection