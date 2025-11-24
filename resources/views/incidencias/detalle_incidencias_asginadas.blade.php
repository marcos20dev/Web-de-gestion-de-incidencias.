@extends('layouts.dashboard')

@section('title', 'Detalle de Incidencia - Incidex')
@section('page-title', 'Detalle de Incidencia Asignada')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-surface-400 hover:text-white transition duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <a href="{{ route('incidencias.asignadas') }}" class="ml-1 text-sm font-medium text-surface-400 hover:text-white transition duration-200">
                                Mis Incidencias Asignadas
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Detalle</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna izquierda - Información de la incidencia -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Header de la incidencia -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-2">{{ $incidencia->titulo }}</h1>
                            <div class="flex items-center space-x-4">
                                @php
                                    $estadoColors = [
                                        'pendiente' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                        'asignada' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                        'en_proceso' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                        'resuelta' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                        'cerrada' => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                    ];
                                    $prioridadColors = [
                                        'baja' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                        'media' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                        'alta' => 'bg-orange-500/20 text-orange-400 border-orange-500/30',
                                        'critica' => 'bg-red-500/20 text-red-400 border-red-500/30'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $estadoColors[$incidencia->estado] }} capitalize">
                                    {{ str_replace('_', ' ', $incidencia->estado) }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $prioridadColors[$incidencia->prioridad] }} capitalize">
                                    {{ $incidencia->prioridad }}
                                </span>
                                <span class="text-surface-400 text-sm">
                                    ID: #{{ str_pad($incidencia->id_incidencias, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <p class="text-surface-300 leading-relaxed">{{ $incidencia->descripcion }}</p>
                </div>

                <!-- Información detallada -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Información de la Incidencia</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-surface-400 text-sm">Categoría</label>
                            <p class="text-white">{{ $incidencia->categoria }}</p>
                        </div>
                        <div>
                            <label class="text-surface-400 text-sm">Ubicación</label>
                            <p class="text-white">{{ $incidencia->ubicacion ?? 'No especificada' }}</p>
                        </div>
                        <div>
                            <label class="text-surface-400 text-sm">Fecha de creación</label>
                            <p class="text-white">{{ $incidencia->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-surface-400 text-sm">Fecha límite</label>
                            <p class="text-white">
                                @if($incidencia->fecha_limite)
                                    {{ $incidencia->fecha_limite->format('d/m/Y H:i') }}
                                    @php
                                        $hoy = now();
                                        $diasRestantes = $hoy->diffInDays($incidencia->fecha_limite, false);
                                    @endphp
                                    @if($diasRestantes < 0)
                                        <span class="text-red-400 ml-2">(Vencida)</span>
                                    @elseif($diasRestantes == 0)
                                        <span class="text-orange-400 ml-2">(Hoy)</span>
                                    @elseif($diasRestantes <= 2)
                                        <span class="text-yellow-400 ml-2">({{ $diasRestantes }} días)</span>
                                    @endif
                                @else
                                    No establecida
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="text-surface-400 text-sm">Reportado por</label>
                            <p class="text-white">
                                @if($incidencia->usuario)
                                    {{ $incidencia->usuario->nombre }} {{ $incidencia->usuario->apellido_paterno }}
                                @else
                                    Usuario no disponible
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="text-surface-400 text-sm">Fecha de asignación</label>
                            <p class="text-white">
                                @if($incidencia->fecha_asignacion)
                                    {{ $incidencia->fecha_asignacion->format('d/m/Y H:i') }}
                                @else
                                    No asignada
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Evidencia de imagen -->
                @if($incidencia->imagen_evidencia)
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Evidencia Adjunta</h3>
                    <div class="flex justify-center">
                        <img src="data:image/jpeg;base64,{{ $incidencia->imagen_evidencia }}"
                             alt="Evidencia de la incidencia"
                             class="max-w-full h-auto rounded-lg max-h-96">
                    </div>
                </div>
                @endif
            </div>

            <!-- Columna derecha - Acciones y formularios -->
            <div class="space-y-6">
                <!-- Acciones rápidas -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Acciones</h3>
                    <div class="space-y-3">
                        @if($incidencia->estado == 'asignada')
                            <button onclick="cambiarEstado({{ $incidencia->id_incidencias }}, 'en_proceso')"
                                    class="w-full px-4 py-3 bg-blue-500/20 hover:bg-blue-500/30 border border-blue-500/30 text-blue-400 rounded-xl transition duration-200 flex items-center justify-center space-x-2">
                                <i class="fas fa-play"></i>
                                <span>Iniciar Trabajo</span>
                            </button>
                        @endif

                        @if($incidencia->estado == 'en_proceso')
                            <button onclick="cambiarEstado({{ $incidencia->id_incidencias }}, 'resuelta')"
                                    class="w-full px-4 py-3 bg-green-500/20 hover:bg-green-500/30 border border-green-500/30 text-green-400 rounded-xl transition duration-200 flex items-center justify-center space-x-2">
                                <i class="fas fa-check"></i>
                                <span>Marcar como Resuelta</span>
                            </button>
                        @endif

                        <a href="{{ route('incidencias.asignadas') }}"
                           class="w-full px-4 py-3 bg-surface-700 hover:bg-surface-600 border border-surface-600 text-white rounded-xl transition duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span>Volver a la lista</span>
                        </a>
                    </div>
                </div>

                <!-- Formulario de actualización -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Actualizar Incidencia</h3>
                    <form action="{{ route('incidencias.asignadas.update', $incidencia) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="space-y-4">
                            <div>
                                <label class="block text-surface-400 text-sm mb-2">Estado Actual</label>
                                <select name="estado" class="w-full bg-surface-800 border border-surface-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-primary-500">
                                    <option value="asignada" {{ $incidencia->estado == 'asignada' ? 'selected' : '' }}>Asignada</option>
                                    <option value="en_proceso" {{ $incidencia->estado == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                    <option value="resuelta" {{ $incidencia->estado == 'resuelta' ? 'selected' : '' }}>Resuelta</option>
                                    <option value="cerrada" {{ $incidencia->estado == 'cerrada' ? 'selected' : '' }}>Cerrada</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-surface-400 text-sm mb-2">Solución</label>
                                <textarea name="solucion" rows="4"
                                          class="w-full bg-surface-800 border border-surface-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-primary-500"
                                          placeholder="Describe la solución aplicada...">{{ old('solucion', $incidencia->solucion) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-surface-400 text-sm mb-2">Comentarios</label>
                                <textarea name="comentarios" rows="3"
                                          class="w-full bg-surface-800 border border-surface-600 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:border-primary-500"
                                          placeholder="Agrega comentarios adicionales...">{{ old('comentarios', $incidencia->comentarios) }}</textarea>
                            </div>

                            <button type="submit"
                                    class="w-full px-4 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)]">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
@if($incidencia->estado == 'en_proceso' && !$incidencia->tieneSolicitudesPendientes())
<div class="glass-effect rounded-2xl p-6 border border-surface-700 mt-6">
    <h3 class="text-lg font-semibold text-white mb-4">¿Necesitas ayuda o aprobación?</h3>
    <p class="text-surface-400 mb-4">Si encuentras obstáculos o necesitas recursos adicionales, puedes solicitar ayuda a un supervisor.</p>
    <a href="{{ route('solicitudes.create', $incidencia) }}"
       class="px-6 py-3 bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white font-medium rounded-xl transition duration-200 flex items-center space-x-2 w-fit">
        <i class="fas fa-handshake"></i>
        <span>Solicitar Aprobación/Recursos</span>
    </a>
</div>
@endif

@if($incidencia->tieneSolicitudesPendientes())
<div class="glass-effect rounded-2xl p-6 border border-blue-500/30 mt-6">
    <div class="flex items-center space-x-3">
        <i class="fas fa-clock text-blue-400 text-xl"></i>
        <div>
            <h3 class="text-lg font-semibold text-white">Solicitud Pendiente</h3>
            <p class="text-surface-400">Tienes una solicitud de aprobación en revisión. Espera la respuesta del supervisor.</p>
        </div>
    </div>
</div>
@endif
                <!-- Información del técnico -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Técnico Asignado</h3>
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-primary-500/20 rounded-full flex items-center justify-center">
                            <span class="text-primary-400 text-lg font-bold">
                                {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-white font-medium">
                                {{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}
                            </p>
                            <p class="text-surface-400 text-sm">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function cambiarEstado(incidenciaId, estado) {
    let mensaje = estado === 'en_proceso'
        ? '¿Estás seguro de que deseas iniciar el trabajo en esta incidencia?'
        : '¿Estás seguro de que deseas marcar esta incidencia como resuelta?';

    if (confirm(mensaje)) {
        fetch(`/incidencias/${incidenciaId}/cambiar-estado`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ estado: estado })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error al cambiar el estado');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cambiar el estado');
        });
    }
}

// Mostrar mensajes de éxito/error
@if(session('success'))
    alert('{{ session('success') }}');
@endif

@if($errors->any())
    alert('Error: {{ $errors->first() }}');
@endif
</script>
@endsection
