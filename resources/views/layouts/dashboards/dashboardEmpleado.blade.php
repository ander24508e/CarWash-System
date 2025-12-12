@extends('menu')
@section('contenido')
<div class="container-fluid">
    <h2><i class="bi bi-person-badge"></i> Mi Panel de Trabajo</h2>
    
    {{-- TARJETAS DE ESTADÍSTICAS --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Ventas Hoy</h5>
                    <h3>{{ $stats_empleado['ventas_hoy'] ?? 0 }}</h3>
                    <p class="text-muted">{{ \Carbon\Carbon::today()->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Ventas del Mes</h5>
                    <h3>{{ $stats_empleado['ventas_mes'] ?? 0 }}</h3>
                    <p class="text-muted">{{ \Carbon\Carbon::now()->format('F') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Ventas</h5>
                    <h3>{{ $stats_empleado['total_ventas'] ?? 0 }}</h3>
                    <p class="text-muted">Acumulado</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Ingresos Totales</h5>
                    <h3>${{ number_format($stats_empleado['total_ingresos'] ?? 0, 2) }}</h3>
                    <p class="text-muted">Generados</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- MIS VENTAS REALIZADAS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="bi bi-receipt-cutoff"></i> Mis Últimas Ventas Realizadas</h5>
                    </a>
                </div>
                <div class="card-body">
                    @if($mis_ventas_realizadas && $mis_ventas_realizadas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Producto/Servicio</th>
                                    <th>Descripción</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mis_ventas_realizadas as $venta)
                                <tr>
                                    <td>#{{ $venta->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($venta->cliente)
                                            {{ $venta->cliente->name ?? 'Cliente' }}
                                        @else
                                            <span class="text-muted">Cliente no registrado</span>
                                        @endif
                                    </td>
                                    <td>{{ $venta->product ?? 'Producto' }}</td>
                                    <td>{{ Str::limit($venta->description, 30) }}</td>
                                    <td><strong>${{ number_format($venta->total, 2) }}</strong></td>
                                    <td>
                                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detallesVenta{{ $venta->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                                {{-- Modal para detalles --}}
                                <div class="modal fade" id="detallesVenta{{ $venta->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalles de Venta #{{ $venta->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }}</p>
                                                @if($venta->cliente)
                                                <p><strong>Cliente:</strong> {{ $venta->cliente->name }} {{ $venta->cliente->apellido ?? '' }}</p>
                                                <p><strong>Email:</strong> {{ $venta->cliente->email ?? 'N/A' }}</p>
                                                <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'N/A' }}</p>
                                                @endif
                                                <p><strong>Producto:</strong> {{ $venta->product }}</p>
                                                <p><strong>Servicio:</strong> {{ $venta->service }}</p>
                                                <p><strong>Descripción:</strong> {{ $venta->description }}</p>
                                                <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
                                                @if($venta->detalles)
                                                <p><strong>Notas:</strong> {{ $venta->detalles }}</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        
                        <h5 class="mt-3">No has realizado ventas aún</h5>
                        <p class="text-muted">Tus ventas aparecerán aquí</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection