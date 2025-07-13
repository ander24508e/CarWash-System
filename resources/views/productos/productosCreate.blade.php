@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>AGREGAR PRODUCTO</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('productos.store') }}">
                @csrf
                @method('POST')
                <div class="mb-3 row">
                    <label for="producto" class="col-sm-2 col-form-label">Producto:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="producto" name="nameProduct"
                            value="{{ old('nameProduct', $productos->nameProduct ?? '') }}">
                    </div>
                    @error('nameProduct')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="categorias" class="col-sm-2 col-form-label">Categoria</label>
                    <div class="col-sm-4">
                        <select id="categorias" name="nameCategoria" class="form-control">
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->name_category }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="stock" class="col-sm-2 col-form-label">Stock disponible:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="stock" name="stock"
                            value="{{ old('stock', $productos->stock ?? '') }}">
                    </div>
                    @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="presentation" class="col-sm-2 col-form-label">Presentacion:</label>
                    <div class="col-sm-4">
                        <select id="presentation" name="presentation" class="form-control" required>
                            <option value="Litro">Litro (1L)</option>
                            <option value="Galón">Galón (5L)</option>
                            <option value="Caneca">Caneca (20L)</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Descripcion del producto:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ old('description', $productos->description ?? '') }}">
                    </div>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="brand" class="col-sm-2 col-form-label">Marca:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="brand" name="brand"
                            value="{{ old('brand', $productos->brand ?? '') }}">
                    </div>
                    @error('brand')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="supplier" class="col-sm-2 col-form-label">Proveedor:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="supplier" name="supplier"
                            value="{{ old('supplier', $productos->supplier ?? '') }}">
                    </div>
                    @error('supplier')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="precio_compra" class="col-sm-2 col-form-label">Precio Compra:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="precio_compra" name="precio_compra"
                            value="{{ old('precio_compra', $productos->precio_compra ?? '') }}">
                    </div>
                    @error('precio_compra')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="precio_venta" class="col-sm-2 col-form-label">Precio Venta:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="precio_venta" name="precio_venta"
                            value="{{ old('precio_venta', $productos->precio_venta ?? '') }}" readonly>
                    </div>
                    @error('precio_venta')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <script>
                    document.getElementById('precio_compra').addEventListener('input', function() {
                        const precioCompra = parseFloat(this.value) || 0;
                        const iva = 0.30; // 12%
                        const precioVenta = precioCompra * (1 + iva);

                        document.getElementById('precio_venta').value = precioVenta.toFixed(2);
                    });
                </script>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">AGREGAR</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection