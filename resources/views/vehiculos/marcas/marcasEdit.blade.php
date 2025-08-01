@extends('menu')
@section('contenido')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>EDITAR MARCA</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('marcas.update', $marca->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3 row">
                    <label for="marca" class="col-sm-2 col-form-label">Marca del Vehiculo:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="marca" name="name_brand"
                            value="{{ old('name_brand', $marca->name_brand) }}">
                    </div>
                    @error('name_brand')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="image" class="col-sm-2 col-form-label">Logo de la Marca:</label>
                    <div class="col-sm-8">
                        <!-- Mostrar imagen actual -->
                        @if($marca->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$marca->image) }}" alt="Logo actual"
                                style="max-height: 150px; margin-bottom: 10px;">
                            <p class="text-muted">Imagen actual</p>
                        </div>
                        @endif

                        <input type="file" class="form-control" id="image" name="image"
                            accept="image/jpeg, image/png, image/jpg, image/gif" onchange="previewImage(event)">

                        <img id="preview" src="#" alt="Vista previa" class="mt-2"
                            style="max-height: 150px; display: none;">

                        <script>
                            function previewImage(event) {
                                const preview = document.getElementById('preview');
                                const file = event.target.files[0];
                                if (file) {
                                    preview.src = URL.createObjectURL(file);
                                    preview.style.display = 'block';
                                } else {
                                    preview.style.display = 'none';
                                }
                            }
                        </script>

                        <small class="text-muted">Formatos aceptados: JPEG, PNG, JPG, GIF (Max 2MB)</small>
                        @error('image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">ACTUALIZAR</button>
                    <a href="{{ route('marcas.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection