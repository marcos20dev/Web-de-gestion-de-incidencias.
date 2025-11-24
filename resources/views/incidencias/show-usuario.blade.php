@extends('layouts.dashboard')

@section('title', 'Detalle de Incidencia - Incidex')

@section('content')
<div class="min-h-screen bg-slate-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumbs mejorados -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-all duration-300 group">
                            <div class="w-8 h-8 bg-slate-800/50 rounded-lg flex items-center justify-center mr-2 group-hover:bg-blue-500/20 transition-colors duration-300">
                                <i class="fas fa-home text-slate-400 group-hover:text-blue-400"></i>
                            </div>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                            <a href="{{ route('incidencias.mis') }}"
                               class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-300">
                                Mis Incidencias
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                            <span class="ml-1 text-sm font-medium text-blue-400 bg-blue-500/10 px-3 py-1 rounded-full border border-blue-500/20">
                                Detalle #{{ $incidencia->id_incidencias }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header principal reorganizado -->
        <div class="mb-8">
            <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-8 border border-slate-700/50">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="bg-gradient-to-br from-blue-500/20 to-cyan-500/20 p-4 rounded-2xl border border-blue-500/30">
                                <i class="fas fa-ticket-alt text-blue-400 text-2xl"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2 leading-tight">
                                    {{ $incidencia->titulo }}
                                </h1>
                                <div class="flex flex-wrap gap-2">
                                    @php
                                        $prioridadColors = [
                                            'baja' => 'bg-green-500/20 text-green-300 border-green-500/30',
                                            'media' => 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30',
                                            'alta' => 'bg-orange-500/20 text-orange-300 border-orange-500/30',
                                            'critica' => 'bg-red-500/20 text-red-300 border-red-500/30',
                                        ];
                                        $estadoColors = [
                                            'pendiente' => 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30',
                                            'asignada' => 'bg-blue-500/20 text-blue-300 border-blue-500/30',
                                            'en_proceso' => 'bg-purple-500/20 text-purple-300 border-purple-500/30',
                                            'resuelta' => 'bg-green-500/20 text-green-300 border-green-500/30',
                                            'cerrada' => 'bg-gray-500/20 text-gray-300 border-gray-500/30',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold {{ $prioridadColors[$incidencia->prioridad] }}">
                                        <i class="fas fa-flag text-current text-xs mr-2"></i>
                                        {{ ucfirst($incidencia->prioridad) }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold {{ $estadoColors[$incidencia->estado] }}">
                                        <i class="fas fa-circle text-current text-xs mr-2"></i>
                                        {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p class="text-slate-300 text-lg leading-relaxed">
                            {{ Str::limit($incidencia->descripcion, 120) }}
                        </p>
                    </div>

                    <!-- Información rápida en sidebar -->
                    <div class="lg:w-80 space-y-4">
                        <div class="bg-slate-700/30 rounded-xl p-4 border border-slate-600/50">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <div class="text-slate-400 mb-1">Categoría</div>
                                    <div class="text-white font-medium">{{ $incidencia->categoria }}</div>
                                </div>
                                <div>
                                    <div class="text-slate-400 mb-1">Ubicación</div>
                                    <div class="text-white font-medium">{{ $incidencia->ubicacion ?? 'N/A' }}</div>
                                </div>
                                <div>
                                    <div class="text-slate-400 mb-1">Fecha creación</div>
                                    <div class="text-white font-medium">{{ $incidencia->created_at->format('d/m/Y H:i') }}</div>
                                </div>
                                <div>
                                    <div class="text-slate-400 mb-1">Fecha límite</div>
                                    <div class="text-white font-medium">
                                        @if($incidencia->fecha_limite)
                                            {{ $incidencia->fecha_limite->format('d/m/Y H:i') }}
                                        @else
                                            No establecida
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido Principal en grid mejorado -->
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-8">
            <!-- Columna Principal - 3/4 del ancho -->
            <div class="xl:col-span-3 space-y-8">
                <!-- Descripción Completa -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-8 border border-slate-700/50">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-xl flex items-center justify-center mr-4 border border-blue-500/30">
                            <i class="fas fa-file-alt text-blue-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">Descripción Completa</h3>
                    </div>
                    <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                        <p class="text-slate-200 leading-relaxed whitespace-pre-line">{{ $incidencia->descripcion }}</p>
                    </div>
                </div>

                <!-- Información Detallada en grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Información Técnica -->
                    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3 border border-purple-500/30">
                                <i class="fas fa-info-circle text-purple-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white">Información Técnica</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/50">
                                <span class="text-slate-400">ID Incidencia:</span>
                                <span class="text-white font-mono">#{{ $incidencia->id_incidencias }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/50">
                                <span class="text-slate-400">Última actualización:</span>
                                <span class="text-white">{{ $incidencia->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if($incidencia->fecha_resolucion)
                            <div class="flex justify-between items-center py-2 border-b border-slate-600/50">
                                <span class="text-slate-400">Fecha resolución:</span>
                                <span class="text-green-400 font-medium">{{ $incidencia->fecha_resolucion->format('d/m/Y H:i') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Progreso de la Incidencia -->
                    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-violet-500/20 rounded-lg flex items-center justify-center mr-3 border border-violet-500/30">
                                <i class="fas fa-tasks text-violet-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white">Estado Actual</h3>
                        </div>
                        <div class="space-y-3">
                            @php
                                $estados = [
                                    'pendiente' => ['icon' => 'fa-clock', 'color' => 'yellow', 'label' => 'Reportada'],
                                    'asignada' => ['icon' => 'fa-user-check', 'color' => 'blue', 'label' => 'Asignada'],
                                    'en_proceso' => ['icon' => 'fa-cog', 'color' => 'purple', 'label' => 'En Proceso'],
                                    'resuelta' => ['icon' => 'fa-check-circle', 'color' => 'green', 'label' => 'Resuelta'],
                                    'cerrada' => ['icon' => 'fa-archive', 'color' => 'gray', 'label' => 'Cerrada'],
                                ];
                                $estadoActual = array_search($incidencia->estado, array_keys($estados));
                            @endphp

                            @foreach($estados as $estado => $info)
                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-6 h-6 rounded-full flex items-center justify-center
                                            {{ $loop->index <= $estadoActual ? 'bg-' . $info['color'] . '-500/20 border border-' . $info['color'] . '-500/30' : 'bg-slate-700/50 border border-slate-600' }}">
                                            <i class="fas {{ $info['icon'] }} text-xs
                                                {{ $loop->index <= $estadoActual ? 'text-' . $info['color'] . '-400' : 'text-slate-500' }}"></i>
                                        </div>
                                        <span class="text-sm {{ $loop->index <= $estadoActual ? 'text-white' : 'text-slate-400' }}">
                                            {{ $info['label'] }}
                                        </span>
                                    </div>
                                    @if($loop->index == $estadoActual)
                                    <span class="text-xs text-{{ $info['color'] }}-400 font-medium bg-{{ $info['color'] }}500/10 px-2 py-1 rounded">
                                        Actual
                                    </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Solución y Comentarios -->
                @if($incidencia->solucion || $incidencia->comentarios)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if($incidencia->solucion)
                    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center mr-3 border border-green-500/30">
                                <i class="fas fa-check-circle text-green-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white">Solución Aplicada</h3>
                        </div>
                        <div class="bg-green-500/5 rounded-lg p-4 border border-green-500/20">
                            <p class="text-slate-200 leading-relaxed whitespace-pre-line text-sm">{{ $incidencia->solucion }}</p>
                            @if($incidencia->fecha_resolucion)
                            <div class="mt-3 pt-3 border-t border-green-500/20">
                                <div class="text-green-400 text-xs">
                                    <i class="fas fa-calendar-check mr-1"></i>
                                    Resuelto el {{ $incidencia->fecha_resolucion->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($incidencia->comentarios)
                    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3 border border-orange-500/30">
                                <i class="fas fa-comment text-orange-400 text-sm"></i>
                            </div>
                            <h3 class="text-lg font-bold text-white">Comentarios</h3>
                        </div>
                        <div class="bg-orange-500/5 rounded-lg p-4 border border-orange-500/20">
                            <p class="text-slate-200 leading-relaxed whitespace-pre-line text-sm">{{ $incidencia->comentarios }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Imagen de Evidencia -->
                @if($incidencia->imagen_evidencia)
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-pink-500/20 rounded-lg flex items-center justify-center mr-3 border border-pink-500/30">
                            <i class="fas fa-image text-pink-400 text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Evidencia Adjunta</h3>
                    </div>
                    <div class="flex justify-center">
                        <img src="data:image/jpeg;base64,{{ $incidencia->imagen_evidencia }}"
                             alt="Evidencia de la incidencia"
                             class="max-w-full h-auto rounded-lg shadow-lg max-h-80 border border-slate-600/50">
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar - 1/4 del ancho -->
            <div class="xl:col-span-1 space-y-8">
                <!-- Técnico Asignado -->
                <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-cyan-500/20 rounded-lg flex items-center justify-center mr-3 border border-cyan-500/30">
                            <i class="fas fa-user-cog text-cyan-400 text-sm"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Técnico</h3>
                    </div>

                    @if($incidencia->tecnico)
                    <div class="text-center">
                        <div class="relative inline-block mb-3">
                            <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl border-2 border-cyan-400/50">
                                {{ substr($incidencia->tecnico->nombre, 0, 1) }}{{ substr($incidencia->tecnico->apellido_paterno, 0, 1) }}
                            </div>
                        </div>
                        <div class="font-semibold text-white text-lg mb-1">{{ $incidencia->tecnico->nombre }} {{ $incidencia->tecnico->apellido_paterno }}</div>
                        <div class="text-slate-400 text-sm mb-3">{{ $incidencia->tecnico->email }}</div>
                        <div class="bg-cyan-500/10 text-cyan-300 px-3 py-1 rounded-full text-xs border border-cyan-500/30 inline-block">
                            Técnico Especializado
                        </div>
                        @if($incidencia->fecha_asignacion)
                        <div class="mt-4 p-3 bg-cyan-500/5 rounded-lg border border-cyan-500/20">
                            <div class="text-cyan-300 text-xs">
                                <i class="fas fa-clock mr-1"></i>
                                Asignado el {{ $incidencia->fecha_asignacion->format('d/m/Y') }}
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="fas fa-user-slash text-gray-400 text-2xl mb-2"></i>
                        <p class="text-gray-400 text-sm">Esperando asignación de técnico</p>
                    </div>
                    @endif
                </div>




            </div>
        </div>
    </div>
</div>
@endsection
