@extends('menu')
@section('contenido')
<div class="container-fluid">
    <h2><i class="bi bi-person-circle"></i> Mi Panel de Cliente</h2>
    
    {{-- TARJETAS DE ESTADÍSTICAS --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Mis Compras</h5>
                    <h3>{{ $stats_cliente['total_compras'] ?? 0 }}</h3>
                    <p class="text-muted">Total</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Gasto Total</h5>
                    <h3>${{ number_format($stats_cliente['gasto_total'] ?? 0, 2) }}</h3>
                    <p class="text-muted">Acumulado</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Compras este Mes</h5>
                    <h3>{{ $stats_cliente['compras_mes'] ?? 0 }}</h3>
                    <p class="text-muted">Mes actual</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Última Compra</h5>
                    <h4>{{ $stats_cliente['ultima_compra'] ?? 'N/A' }}</h4>
                    <p class="text-muted">Fecha</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- MIS VENTAS --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="bi bi-receipt"></i> Mis Últimas Compras</h5>
                </div>
                <div class="card-body">
                    @if($mis_ventas && $mis_ventas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Producto/Servicio</th>
                                    <th>Descripción</th>
                                    <th>Atendido por</th>
                                    <th>Total</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mis_ventas as $venta)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y') }}</td>
                                    <td>{{ $venta->product ?? 'Producto' }}</td>
                                    <td>{{ $venta->description ?? 'Descripción' }}</td>
                                    <td>
                                        @if($venta->empleado)
                                            {{ $venta->empleado->name ?? 'Empleado' }}
                                        @else
                                            <span class="text-muted">No disponible</span>
                                        @endif
                                    </td>
                                    <td>${{ number_format($venta->total, 2) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detallesVenta{{ $venta->id }}">
                                            <i class="bi bi-eye"></i> Ver
                                        </button>
                                    </td>
                                </tr>
                                
                                {{-- Modal para detalles --}}
                                <div class="modal fade" id="detallesVenta{{ $venta->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detalles de Compra #{{ $venta->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d/m/Y H:i') }}</p>
                                                <p><strong>Producto:</strong> {{ $venta->product }}</p>
                                                <p><strong>Servicio:</strong> {{ $venta->service }}</p>
                                                <p><strong>Descripción:</strong> {{ $venta->description }}</p>
                                                <p><strong>Total:</strong> ${{ number_format($venta->total, 2) }}</p>
                                                @if($venta->detalles)
                                                <p><strong>Notas:</strong> {{ $venta->detalles }}</p>
                                                @endif
                                                @if($venta->empleado)
                                                <p><strong>Atendido por:</strong> {{ $venta->empleado->name }} {{ $venta->empleado->apellido ?? '' }}</p>
                                                @endif
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
                        <i class="bi bi-cart-x" style="font-size: 3rem; color: #6c757d;"></i>
                        <h5 class="mt-3">No tienes compras registradas</h5>
                        <p class="text-muted">Tus compras aparecerán aquí</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- ACCIONES RÁPIDAS --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body text-center">
                    <h5><i class="bi bi-question-circle"></i> ¿Necesitas ayuda?</h5>
                    <p class="mb-3">Para agendar un nuevo servicio, contacta con nuestro personal.</p>
                    <a href="tel:+1234567890" class="btn btn-primary me-2">
                        <i class="bi bi-telephone"></i> Llamar
                    </a>
                    <a href="mailto:contacto@tudominio.com" class="btn btn-success">
                        <i class="bi bi-envelope"></i> Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ESTILOS ADICIONALES --}}
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
    }
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
</style>
@endsection