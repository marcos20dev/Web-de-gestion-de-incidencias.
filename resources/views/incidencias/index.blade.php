@extends('layouts.app')

@section('title', 'Todas las Incidencias')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-list-alt me-2"></i>Todas las Incidencias
                    </h4>
                    <div>
                        <span class="badge bg-light text-dark fs-6">{{ $incidencias->count() }} incidencias</span>
                    </div>
                </div>

                <div class="card-body p-0">
                    @if($incidencias->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="ps-3">ID</th>
                                        <th>Título</th>
                                        <th>Usuario</th>
                                        <th>Técnico</th>
                                        <th>Prioridad</th>
                                        <th>Estado</th>
                                        <th>Categoría</th>
                                        <th>Fecha Creación</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incidencias as $incidencia)
                                        <tr class="align-middle">
                                            <td class="ps-3 fw-bold">#{{ $incidencia->id_incidencias ?? $incidencia->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="fw-semibold text-truncate" style="max-width: 200px;">
                                                        {{ $incidencia->titulo }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $incidencia->usuario->name ?? 'N/A' }}
                                                </small>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $incidencia->tecnico->name ?? 'Sin asignar' }}
                                                </small>
                                            </td>
                                            <td>
                                                @php
                                                    $prioridadClass = [
                                                        'baja' => 'success',
                                                        'media' => 'warning',
                                                        'alta' => 'danger',
                                                        'critica' => 'dark'
                                                    ][$incidencia->prioridad] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $prioridadClass }}">
                                                    {{ ucfirst($incidencia->prioridad) }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $estadoClass = [
                                                        'pendiente' => 'secondary',
                                                        'asignada' => 'info',
                                                        'en_proceso' => 'primary',
                                                        'resuelta' => 'success',
                                                        'cerrada' => 'dark'
                                                    ][$incidencia->estado] ?? 'secondary';
                                                @endphp
                                                <span class="badge bg-{{ $estadoClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $incidencia->categoria }}
                                                </small>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $incidencia->created_at->format('d/m/Y H:i') }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('incidencias.show', $incidencia) }}"
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Ver detalles">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @can('update', $incidencia)
                                                        <a href="{{ route('incidencias.edit', $incidencia) }}"
                                                           class="btn btn-sm btn-outline-warning"
                                                           title="Editar incidencia">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-inbox fa-4x text-muted"></i>
                            </div>
                            <h4 class="text-muted">No hay incidencias registradas</h4>
                            <p class="text-muted">No se han encontrado incidencias en el sistema.</p>
                        </div>
                    @endif
                </div>

                @if($incidencias->hasPages())
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-center">
                            {{ $incidencias->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.table th {
    border-top: none;
    font-weight: 600;
    font-size: 0.875rem;
}
.table td {
    vertical-align: middle;
}
.badge {
    font-size: 0.75rem;
}
.card {
    border: none;
    border-radius: 12px;
}
.card-header {
    border-radius: 12px 12px 0 0 !important;
}
</style>
@endsection
