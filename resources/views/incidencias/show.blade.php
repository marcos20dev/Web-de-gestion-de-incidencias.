@extends('layouts.dashboard')

@section('title', 'Detalles de Incidencia - Incidex')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumbs -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2"></i>
                            <a href="{{ route('incidencias.mis') }}"
                                class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">
                                Mis Incidencias
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-green-400">Detalles</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header de la Incidencia -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-slate-900/80 to-green-900/20 rounded-2xl shadow-2xl overflow-hidden border border-slate-700/50 backdrop-blur-xl">
                <div class="px-8 py-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-4">
                                <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 p-4 rounded-2xl border border-green-500/30 shadow-lg">
                                    <i class="fas fa-ticket-alt text-green-400 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">{{ $incidencia->titulo }}</h1>
                                    <div class="flex flex-wrap gap-2">
                                        @php
                                            $prioridadClasses = [
                                                'baja' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                                'media' => 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30',
                                                'alta' => 'bg-orange-500/20 text-orange-300 border border-orange-500/30',
                                                'critica' => 'bg-red-500/20 text-red-300 border border-red-500/30',
                                            ];
                                            $prioridadClass = $prioridadClasses[$incidencia->prioridad] ?? 'bg-slate-700 text-slate-300 border border-slate-600';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold {{ $prioridadClass }}">
                                            {{ ucfirst($incidencia->prioridad) }}
                                        </span>

                                        @php
                                            $estadoClasses = [
                                                'pendiente' => 'bg-slate-600/50 text-slate-300 border border-slate-500',
                                                'asignada' => 'bg-blue-500/20 text-blue-300 border border-blue-500/30',
                                                'en_proceso' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                                'resuelta' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                                'cerrada' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                            ];
                                            $estadoClass = $estadoClasses[$incidencia->estado] ?? 'bg-slate-700 text-slate-300 border border-slate-600';
                                        @endphp
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold {{ $estadoClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                                        </span>

                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-bold bg-purple-500/20 text-purple-300 border border-purple-500/30">
                                            {{ $incidencia->categoria }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <span class="text-white font-semibold bg-slate-800/50 backdrop-blur-sm rounded-xl px-4 py-2 border border-slate-700">
                                #{{ $incidencia->id_incidencias ?? $incidencia->id }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Panel de Detalle de Incidencia -->
            <div class="lg:col-span-2">
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-slate-700/50">
                    <!-- Información General y Técnico -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Información General -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                <i class="fas fa-info-circle text-green-400 mr-2"></i>
                                Información General
                            </h3>
                            <div class="space-y-3">
                                <div class="flex">
                                    <span class="w-40 font-medium text-slate-400">Reportada por:</span>
                                    <div>
                                        <span class="font-medium text-white">
                                            {{ $incidencia->usuario->nombre }} {{ $incidencia->usuario->apellido_paterno }} {{ $incidencia->usuario->apellido_materno }}
                                        </span>
                                        <div class="text-sm text-slate-400">{{ $incidencia->usuario->email }}</div>
                                    </div>
                                </div>
                                <div class="flex">
                                    <span class="w-40 font-medium text-slate-400">Fecha creación:</span>
                                    <span class="text-white">{{ $incidencia->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-40 font-medium text-slate-400">Última actualización:</span>
                                    <span class="text-white">{{ $incidencia->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-40 font-medium text-slate-400">Ubicación:</span>
                                    <span class="text-white">{{ $incidencia->ubicacion ?? 'No especificada' }}</span>
                                </div>
                                @if($incidencia->fecha_limite)
                                <div class="flex">
                                    <span class="w-40 font-medium text-slate-400">Fecha límite:</span>
                                    <span class="text-amber-400 font-medium">{{ $incidencia->fecha_limite->format('d/m/Y H:i') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Información del Técnico -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                <i class="fas fa-user-cog text-green-400 mr-2"></i>
                                Técnico Asignado
                            </h3>
                            @if($incidencia->tecnico)
                            <div class="flex items-center space-x-4 p-4 bg-slate-700/50 rounded-xl mb-3">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    {{ substr($incidencia->tecnico->nombre, 0, 1) }}{{ substr($incidencia->tecnico->apellido_paterno, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-white">
                                        {{ $incidencia->tecnico->nombre }} {{ $incidencia->tecnico->apellido_paterno }} {{ $incidencia->tecnico->apellido_materno }}
                                    </div>
                                    <div class="text-sm text-slate-400">{{ $incidencia->tecnico->email }}</div>
                                    <div class="flex items-center mt-1">
                                        <span class="bg-green-500/20 text-green-300 px-2 py-1 rounded-full text-xs mr-2 border border-green-500/30">Disponible</span>
                                    </div>
                                </div>
                            </div>
                            @if($incidencia->fecha_asignacion)
                            <div class="bg-blue-500/10 p-3 rounded-xl border border-blue-500/20">
                                <div class="text-sm text-blue-300">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span class="font-medium">Asignado el:</span> {{ $incidencia->fecha_asignacion->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            @endif
                            @else
                            <div class="text-center p-6 bg-slate-700/50 rounded-xl border border-slate-600">
                                <i class="fas fa-user-slash text-slate-400 text-2xl mb-2"></i>
                                <p class="text-slate-400">Sin técnico asignado</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Descripción y Categoría -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Descripción del Problema -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                <i class="fas fa-file-alt text-green-400 mr-2"></i>
                                Descripción del Problema
                            </h3>
                            <div class="bg-slate-700/50 p-4 rounded-xl border border-slate-600">
                                <p class="text-slate-200">{{ $incidencia->descripcion }}</p>
                            </div>
                        </div>

                        <!-- Información de Categoría -->
                        <div>
                            <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                <i class="fas fa-tag text-green-400 mr-2"></i>
                                Categoría
                            </h3>
                            <div class="flex items-center space-x-3 p-4 bg-slate-700/50 rounded-xl border border-slate-600">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-white">{{ $incidencia->categoria }}</div>
                                    <div class="text-sm text-slate-400">Problemas relacionados con esta categoría</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Solución Aplicada -->
                    @if($incidencia->solucion)
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-check-circle text-green-400 mr-2"></i>
                            Solución Aplicada
                        </h3>
                        <div class="bg-green-500/10 p-4 rounded-xl border border-green-500/20">
                            <p class="text-green-300 whitespace-pre-line">{{ $incidencia->solucion }}</p>
                            @if($incidencia->fecha_resolucion)
                            <div class="mt-3 text-sm text-green-400">
                                <i class="fas fa-calendar-check mr-1"></i>
                                <strong>Resuelto el:</strong> {{ $incidencia->fecha_resolucion->format('d/m/Y H:i') }}
                            </div>
                            @endif
                            @if($incidencia->tecnico)
                            <div class="mt-2 text-sm text-green-400">
                                <i class="fas fa-user-cog mr-1"></i>
                                <strong>Resuelto por:</strong> {{ $incidencia->tecnico->nombre }} {{ $incidencia->tecnico->apellido_paterno }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Comentarios Adicionales -->
                    @if($incidencia->comentarios)
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-comments text-green-400 mr-2"></i>
                            Comentarios Adicionales
                        </h3>
                        <div class="bg-blue-500/10 p-4 rounded-xl border border-blue-500/20">
                            <p class="text-blue-300 whitespace-pre-line">{{ $incidencia->comentarios }}</p>
                            @if($incidencia->tecnico)
                            <div class="mt-2 text-sm text-blue-400">
                                <i class="fas fa-user mr-1"></i>
                                <strong>Por:</strong> {{ $incidencia->tecnico->nombre }} {{ $incidencia->tecnico->apellido_paterno }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Imagen de Evidencia -->
                    @if($incidencia->imagen_evidencia)
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                            <i class="fas fa-image text-green-400 mr-2"></i>
                            Imagen de Evidencia
                        </h3>
                        <div class="bg-slate-700/50 p-4 rounded-xl border border-slate-600">
                            <img src="data:image/jpeg;base64,{{ $incidencia->imagen_evidencia }}"
                                 alt="Evidencia de la incidencia"
                                 class="max-w-full max-h-96 mx-auto rounded-lg shadow-lg">
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Panel Lateral -->
            <div class="lg:col-span-1">
                <!-- Panel de Asignación de Técnico -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-slate-700/50 sticky top-6">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4 rounded-xl mb-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-user-cog mr-2"></i>
                            Asignar Técnico
                        </h2>
                    </div>

                    <!-- Búsqueda de Técnicos -->
                    <div class="mb-4">
                        <div class="relative">
                            <input type="text"
                                   placeholder="Buscar técnico..."
                                   class="w-full pl-10 pr-4 py-2 bg-slate-700/50 border border-slate-600 text-white rounded-xl placeholder-slate-400 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200">
                            <i class="fas fa-search absolute left-3 top-3 text-slate-400"></i>
                        </div>
                    </div>

                    <!-- Lista de Técnicos -->
                    <div class="space-y-3 max-h-80 overflow-y-auto pr-2 mb-4">
                        @foreach($tecnicos as $tecnico)
                        <div class="flex items-center p-3 border border-slate-600 rounded-xl hover:bg-slate-700/50 cursor-pointer transition duration-200 {{ $incidencia->tecnico_id == $tecnico->id ? 'border-2 border-green-500 bg-green-500/10' : '' }}"
                             data-tecnico-id="{{ $tecnico->id }}">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr($tecnico->nombre, 0, 1) }}{{ substr($tecnico->apellido_paterno, 0, 1) }}
                            </div>
                            <div class="ml-3 flex-1">
                                <div class="font-medium text-white">
                                    {{ $tecnico->nombre }} {{ $tecnico->apellido_paterno }} {{ $tecnico->apellido_materno }}
                                </div>
                                <div class="text-xs text-slate-400">{{ $tecnico->rol->nombre ?? 'Técnico' }}</div>
                                <div class="flex items-center mt-1">
                                    @php
                                        $estadoTecnico = $tecnico->estadosTecnico->last();
                                        $disponible = $estadoTecnico && $estadoTecnico->estado === 'disponible';
                                    @endphp
                                    <span class="{{ $disponible ? 'bg-green-500/20 text-green-300 border border-green-500/30' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30' }} px-2 py-1 rounded-full text-xs mr-2">
                                        {{ $disponible ? 'Disponible' : 'Ocupado' }}
                                    </span>
                                    @if($estadoTecnico && $estadoTecnico->observacion)
                                    <span class="text-slate-400 text-xs" title="{{ $estadoTecnico->observacion }}">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @if($incidencia->tecnico_id == $tecnico->id)
                            <div class="text-green-400">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            @endif
                        </div>
                        @endforeach

                        @if($tecnicos->isEmpty())
                        <div class="text-center p-4 bg-slate-700/50 rounded-xl border border-slate-600">
                            <i class="fas fa-users text-slate-400 text-xl mb-2"></i>
                            <p class="text-slate-400 text-sm">No hay técnicos disponibles</p>
                        </div>
                        @endif
                    </div>

                    <!-- Formulario de Asignación -->
                    <form action="{{ route('incidencias.asignar', $incidencia) }}" method="POST" id="formAsignarTecnico">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="tecnico_id" id="tecnicoSeleccionado">

                        <div class="space-y-3">
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white py-3 px-4 rounded-xl font-medium transition duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="btnConfirmarAsignacion"
                                    disabled>
                                <i class="fas fa-user-check mr-2"></i>
                                Confirmar Asignación
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Panel de Métricas -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-slate-700/50 mt-6">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-600 p-4 rounded-xl mb-4">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Métricas
                        </h2>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Tiempo transcurrido:</span>
                            <span class="font-medium text-green-400">{{ $incidencia->created_at->diffForHumans() }}</span>
                        </div>
                        @if($incidencia->fecha_limite)
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Días restantes:</span>
                            <span class="font-medium {{ $incidencia->esta_vencida ? 'text-red-400' : 'text-amber-400' }}">
                                {{ $incidencia->dias_restantes ?? 'N/A' }} días
                            </span>
                        </div>
                        @endif
                        @if($incidencia->fecha_resolucion)
                        <div class="flex justify-between items-center">
                            <span class="text-slate-400">Tiempo resolución:</span>
                            <span class="font-medium text-green-400">
                                {{ $incidencia->created_at->diffInDays($incidencia->fecha_resolucion) }} días
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-slate-700">
            <a href="{{ route('incidencias.mis') }}"
                class="px-6 py-2 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700/50 transition-all duration-200">
                Volver
            </a>
            @can('update', $incidencia)
                <a href="{{ route('incidencias.edit', $incidencia) }}"
                    class="px-6 py-2 bg-amber-500/20 text-amber-400 border border-amber-500/30 rounded-xl hover:bg-amber-500/40 transition-all duration-200">
                    Editar
                </a>
            @endcan
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Script para manejar la selección de técnicos
        const techItems = document.querySelectorAll('.cursor-pointer');
        const tecnicoSeleccionadoInput = document.getElementById('tecnicoSeleccionado');
        const btnConfirmarAsignacion = document.getElementById('btnConfirmarAsignacion');

        techItems.forEach(item => {
            item.addEventListener('click', function() {
                const tecnicoId = this.getAttribute('data-tecnico-id');

                // Remover selección previa
                techItems.forEach(i => {
                    i.classList.remove('border-2', 'border-green-500', 'bg-green-500/10');
                    i.classList.add('border', 'border-slate-600');

                    // Remover icono de check
                    const checkIcon = i.querySelector('.fa-check-circle');
                    if (checkIcon && !i.classList.contains('border-2')) {
                        checkIcon.parentElement.remove();
                    }
                });

                // Aplicar selección al elemento clickeado
                this.classList.remove('border', 'border-slate-600');
                this.classList.add('border-2', 'border-green-500', 'bg-green-500/10');

                // Agregar icono de check si no lo tiene
                if (!this.querySelector('.fa-check-circle')) {
                    const checkDiv = document.createElement('div');
                    checkDiv.className = 'text-green-400';
                    checkDiv.innerHTML = '<i class="fas fa-check-circle"></i>';
                    this.appendChild(checkDiv);
                }

                // Actualizar formulario
                tecnicoSeleccionadoInput.value = tecnicoId;
                btnConfirmarAsignacion.disabled = false;
            });
        });
    });
</script>
@endsection
