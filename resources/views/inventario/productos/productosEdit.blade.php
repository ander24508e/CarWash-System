@extends('menu')
@section('contenido')
@vite(['resources/scss/allStyles.scss'])

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="container">
    <div class="card text-center">
        <div class="card-header">
            <h1>EDITAR PRODUCTO</h1>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('productos.update', ['productos_id' => $productos->id]) }}">
                @csrf
                @method('PUT')
                <div class="mb-3 row">
                    <label for="producto" class="col-sm-2 col-form-label">Producto:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="producto" name="nameProduct">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->name_product ?? 'N/A' }}</strong></small>
                        </div>
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
                            <option value="{{ $categoria->id }}"
                                {{ $productos->name_categoria == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->name_category }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="stock" class="col-sm-2 col-form-label">Stock disponible:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="stock" name="stock">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->stock ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="presentation" class="col-sm-2 col-form-label">Presentación:</label>
                    <div class="col-sm-4">
                        <select id="presentation" name="presentation" class="form-control" required>
                            <option value="Litro" {{ $productos->presentation == 'Litro' ? 'selected' : '' }}>Litro (1L)</option>
                            <option value="Galón" {{ $productos->presentation == 'Galón' ? 'selected' : '' }}>Galón (5L)</option>
                            <option value="Caneca" {{ $productos->presentation == 'Caneca' ? 'selected' : '' }}>Caneca (20L)</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->presentation ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('presentation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Descripcion del producto:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->description ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="brand" class="col-sm-2 col-form-label">Marca:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="brand" name="brand">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->brand ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('brand')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="supplier" class="col-sm-2 col-form-label">Proveedor:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="supplier" name="supplier">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->supplier ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('supplier')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="precio_compra" class="col-sm-2 col-form-label">Precio Compra:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="precio_compra" name="precio_compra">
                    </div>
                    <div class="col-sm-4">
                        <div class="alert alert-info p-2 mb-0">
                            <small>Valor actual: <strong>{{ $productos->precio_compra ?? 'N/A' }}</strong></small>
                        </div>
                    </div>
                    @error('precio_compra')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 row">
                    <label for="precio_venta" class="col-sm-2 col-form-label">Precio Venta:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="precio_venta" name="precio_venta">
                    </div>
                    @error('precio_venta')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <script>
                    document.getElementById('precio_compra').addEventListener('input', function() {
                        const precioCompra = parseFloat(this.value) || 0;
                        const iva = 0.30; // 30%
                        const precioVenta = precioCompra * (1 + iva);

                        document.getElementById('precio_venta').value = precioVenta.toFixed(2);
                    });
                </script>

                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-dark">ACTUALIZAR</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-dark" style="margin-left: 10px;">VOLVER</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection