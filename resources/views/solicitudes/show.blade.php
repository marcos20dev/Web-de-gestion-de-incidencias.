@extends('layouts.dashboard')

@section('title', 'Detalles de Solicitud - Incidex')

@section('content')
    <div class="min-h-screen bg-slate-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumbs Mejorado -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-all duration-300 group">
                                <div
                                    class="w-8 h-8 bg-slate-800/50 rounded-lg flex items-center justify-center mr-2 group-hover:bg-green-500/20 transition-colors duration-300">
                                    <i class="fas fa-home text-slate-400 group-hover:text-green-400"></i>
                                </div>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                                <a href="{{ route('solicitudes.historial') }}"
                                    class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-300">
                                    Historial de Solicitudes
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                                <span
                                    class="ml-1 text-sm font-medium text-green-400 bg-green-500/10 px-3 py-1 rounded-full border border-green-500/20">
                                    Detalles
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Header Mejorado con Animación -->
            <div class="mb-8 transform transition-all duration-500 hover:scale-[1.01]">
                <div
                    class="relative bg-gradient-to-r from-slate-900 via-slate-800 to-green-900/30 rounded-2xl shadow-2xl overflow-hidden border border-slate-700/50 backdrop-blur-xl">
                    <!-- Efecto de partículas en el fondo -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-500/5"></div>
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full -translate-y-16 translate-x-16">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-24 h-24 bg-emerald-500/10 rounded-full translate-y-12 -translate-x-12">
                    </div>

                    <div class="relative p-8">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex items-center space-x-6">
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl blur-lg opacity-30">
                                    </div>
                                    <div
                                        class="relative bg-gradient-to-br from-green-500/20 to-emerald-500/20 p-5 rounded-2xl border border-green-500/30 shadow-lg backdrop-blur-sm">
                                        <i class="fas fa-handshake text-green-400 text-3xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h1 class="text-3xl lg:text-4xl font-bold text-white mb-4 leading-tight">
                                        {{ $solicitud->titulo }}
                                    </h1>
                                    <div class="flex flex-wrap gap-3">
                                        @php
                                            $estadoColors = [
                                                'pendiente' =>
                                                    'bg-yellow-500/20 text-yellow-300 border-yellow-500/30 shadow-lg shadow-yellow-500/10',
                                                'aprobada' =>
                                                    'bg-green-500/20 text-green-300 border-green-500/30 shadow-lg shadow-green-500/10',
                                                'rechazada' =>
                                                    'bg-red-500/20 text-red-300 border-red-500/30 shadow-lg shadow-red-500/10',
                                                'cancelada' =>
                                                    'bg-gray-500/20 text-gray-300 border-gray-500/30 shadow-lg shadow-gray-500/10',
                                            ];
                                            $tipoColors = [
                                                'aprobacion' =>
                                                    'bg-purple-500/20 text-purple-300 border-purple-500/30 shadow-lg shadow-purple-500/10',
                                                'recursos' =>
                                                    'bg-blue-500/20 text-blue-300 border-blue-500/30 shadow-lg shadow-blue-500/10',
                                                'asistencia' =>
                                                    'bg-orange-500/20 text-orange-300 border-orange-500/30 shadow-lg shadow-orange-500/10',
                                                'otros' =>
                                                    'bg-gray-500/20 text-gray-300 border-gray-500/30 shadow-lg shadow-gray-500/10',
                                            ];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold {{ $estadoColors[$solicitud->estado] }} capitalize transition-all duration-300 hover:scale-105">
                                            <i class="fas fa-circle text-current text-xs mr-2 animate-pulse"></i>
                                            {{ $solicitud->estado }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold {{ $tipoColors[$solicitud->tipo] }} transition-all duration-300 hover:scale-105">
                                            <i class="fas fa-tag text-current text-xs mr-2"></i>
                                            {{ $solicitud->tipo_texto }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-4 py-2 text-white font-semibold bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-600/50 transition-all duration-300 hover:bg-slate-700/50">
                                            <i class="fas fa-hashtag text-green-400 mr-2"></i>
                                            #{{ $solicitud->id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal Mejorado -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Columna Principal - Más Ancha -->
                <div class="xl:col-span-2 space-y-8">
                    <!-- Tarjeta de Descripción con Efectos -->
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-emerald-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-8 border border-slate-700/50 hover:border-green-500/30 transition-all duration-500">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-xl flex items-center justify-center mr-4 border border-green-500/30">
                                    <i class="fas fa-file-alt text-green-400 text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white">Descripción de la Solicitud</h3>
                            </div>
                            <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                                <p class="text-slate-200 leading-relaxed text-lg whitespace-pre-line">
                                    {{ $solicitud->descripcion }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de Justificación -->
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-cyan-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-8 border border-slate-700/50 hover:border-blue-500/30 transition-all duration-500">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-500/20 to-cyan-500/20 rounded-xl flex items-center justify-center mr-4 border border-blue-500/30">
                                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white">Justificación</h3>
                            </div>
                            <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                                <p class="text-slate-200 leading-relaxed text-lg whitespace-pre-line">
                                    {{ $solicitud->justificacion }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recursos Solicitados (Condicional) -->
                    @if ($solicitud->recursos_solicitados)
                        <div class="group relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-orange-500/10 to-amber-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div
                                class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-8 border border-slate-700/50 hover:border-orange-500/30 transition-all duration-500">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-orange-500/20 to-amber-500/20 rounded-xl flex items-center justify-center mr-4 border border-orange-500/30">
                                        <i class="fas fa-tools text-orange-400 text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-white">Recursos Solicitados</h3>
                                </div>
                                <div class="bg-slate-700/30 rounded-xl p-6 border border-slate-600/50">
                                    <p class="text-slate-200 leading-relaxed text-lg whitespace-pre-line">
                                        {{ $solicitud->recursos_solicitados }}</p>
                                    @if ($solicitud->costo_estimado)
                                        <div
                                            class="mt-6 p-4 bg-gradient-to-r from-blue-500/10 to-cyan-500/10 rounded-xl border border-blue-500/20">
                                            <div class="flex items-center justify-between">
                                                <span class="text-blue-300 font-semibold text-lg">Costo Estimado</span>
                                                <span class="text-2xl font-bold text-white">S/
                                                    {{ number_format($solicitud->costo_estimado, 2) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Comentarios del Supervisor (Condicional) -->
                    @if ($solicitud->comentarios_supervisor)
                        <div class="group relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-pink-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div
                                class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-8 border border-slate-700/50 hover:border-purple-500/30 transition-all duration-500">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-purple-500/20 to-pink-500/20 rounded-xl flex items-center justify-center mr-4 border border-purple-500/30">
                                        <i class="fas fa-comment text-purple-400 text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-white">Comentarios del Supervisor</h3>
                                </div>
                                <div
                                    class="bg-gradient-to-br from-purple-500/10 to-pink-500/5 rounded-xl p-6 border border-purple-500/20">
                                    <p class="text-slate-200 leading-relaxed text-lg whitespace-pre-line">
                                        {{ $solicitud->comentarios_supervisor }}</p>
                                    @if ($solicitud->supervisor)
                                        <div
                                            class="mt-6 flex items-center justify-between pt-4 border-t border-purple-500/20">
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                    {{ substr($solicitud->supervisor->nombre, 0, 1) }}{{ substr($solicitud->supervisor->apellido_paterno, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-purple-300 font-semibold">
                                                        {{ $solicitud->supervisor->nombre }}
                                                        {{ $solicitud->supervisor->apellido_paterno }}</div>
                                                    <div class="text-purple-400 text-sm">Supervisor</div>
                                                </div>
                                            </div>
                                            @if ($solicitud->fecha_aprobacion)
                                                <div class="text-purple-400 text-sm">
                                                    {{ $solicitud->fecha_aprobacion->format('d/m/Y H:i') }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar Mejorado -->
                <div class="space-y-8">
                    <!-- Información de Incidencia -->
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-blue-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 hover:border-cyan-500/30 transition-all duration-500">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-cyan-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-3 border border-cyan-500/30">
                                    <i class="fas fa-ticket-alt text-cyan-400"></i>
                                </div>
                                <h3 class="text-lg font-bold text-white">Incidencia Relacionada</h3>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center p-3 bg-slate-700/30 rounded-lg">
                                    <span class="text-slate-400 text-sm">ID:</span>
                                    <span
                                        class="text-white font-mono font-bold">#{{ $solicitud->incidencia->id_incidencias }}</span>
                                </div>
                                <div class="p-3 bg-slate-700/30 rounded-lg">
                                    <span class="text-slate-400 text-sm block mb-1">Título:</span>
                                    <p class="text-white text-sm leading-relaxed">{{ $solicitud->incidencia->titulo }}</p>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-slate-700/30 rounded-lg">
                                    <span class="text-slate-400 text-sm">Estado:</span>
                                    @php
                                        $incidenciaEstadoColors = [
                                            'pendiente' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                            'asignada' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                            'en_proceso' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                            'resuelta' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                            'cerrada' => 'bg-gray-500/20 text-gray-400 border-gray-500/30',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-medium border {{ $incidenciaEstadoColors[$solicitud->incidencia->estado] }} capitalize">
                                        {{ str_replace('_', ' ', $solicitud->incidencia->estado) }}
                                    </span>
                                </div>
                                <a href="{{ route('incidencias.asignadas.show', $solicitud->incidencia) }}"
                                    class="w-full px-4 py-3 bg-gradient-to-r from-cyan-500/20 to-blue-500/20 text-cyan-300 border border-cyan-500/30 rounded-xl hover:from-cyan-500/30 hover:to-blue-500/30 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                    <i
                                        class="fas fa-external-link-alt group-hover:scale-110 transition-transform duration-300"></i>
                                    <span>Ver Incidencia</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Técnico -->
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 to-green-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 hover:border-emerald-500/30 transition-all duration-500">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-emerald-500/20 to-green-500/20 rounded-lg flex items-center justify-center mr-3 border border-emerald-500/30">
                                    <i class="fas fa-user-cog text-emerald-400"></i>
                                </div>
                                <h3 class="text-lg font-bold text-white">Técnico Solicitante</h3>
                            </div>
                            <div class="flex items-center space-x-4 p-4 bg-slate-700/30 rounded-xl">
                                <div class="relative">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full blur-md opacity-50">
                                    </div>
                                    <div
                                        class="relative w-14 h-14 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg border-2 border-emerald-400/50">
                                        {{ substr($solicitud->tecnico->nombre, 0, 1) }}{{ substr($solicitud->tecnico->apellido_paterno, 0, 1) }}
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-white text-lg">{{ $solicitud->tecnico->nombre }}
                                        {{ $solicitud->tecnico->apellido_paterno }}</div>
                                    <div class="text-slate-400 text-sm">{{ $solicitud->tecnico->email }}</div>
                                    <div class="flex items-center mt-1">
                                        <span
                                            class="bg-emerald-500/20 text-emerald-300 px-2 py-1 rounded-full text-xs border border-emerald-500/30">
                                            Técnico
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de la Solicitud -->
                    <div class="group relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-violet-500/10 to-purple-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div
                            class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 hover:border-violet-500/30 transition-all duration-500">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-violet-500/20 to-purple-500/20 rounded-lg flex items-center justify-center mr-3 border border-violet-500/30">
                                    <i class="fas fa-info-circle text-violet-400"></i>
                                </div>
                                <h3 class="text-lg font-bold text-white">Información de la Solicitud</h3>
                            </div>
                            <div class="space-y-3">
                                @php
                                    $timelineItems = [
                                        [
                                            'icon' => 'fa-calendar-plus',
                                            'color' => 'text-blue-400',
                                            'label' => 'Creada',
                                            'date' => $solicitud->created_at,
                                        ],
                                        [
                                            'icon' => 'fa-calendar-check',
                                            'color' => 'text-green-400',
                                            'label' => 'Aprobada',
                                            'date' => $solicitud->fecha_aprobacion,
                                        ],
                                        [
                                            'icon' => 'fa-calendar-times',
                                            'color' => 'text-red-400',
                                            'label' => 'Rechazada',
                                            'date' => $solicitud->fecha_rechazo,
                                        ],
                                        [
                                            'icon' => 'fa-calendar-alt',
                                            'color' => 'text-slate-400',
                                            'label' => 'Actualizada',
                                            'date' => $solicitud->updated_at,
                                        ],
                                    ];
                                @endphp

                                @foreach ($timelineItems as $item)
                                    @if ($item['date'])
                                        <div
                                            class="flex items-center justify-between p-3 bg-slate-700/30 rounded-lg hover:bg-slate-600/30 transition-colors duration-300">
                                            <div class="flex items-center space-x-3">
                                                <i class="fas {{ $item['icon'] }} {{ $item['color'] }} text-sm"></i>
                                                <span class="text-slate-400 text-sm">{{ $item['label'] }}:</span>
                                            </div>
                                            <span
                                                class="text-white text-sm font-medium">{{ $item['date']->format('d/m/Y H:i') }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Acciones Dinámicas -->
                    @if (auth()->user()->hasRole(['Supervisor', 'Administrador']) && $solicitud->estado == 'pendiente')
                        <div class="group relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-emerald-500/5 rounded-2xl blur-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            <div
                                class="relative bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 hover:border-green-500/30 transition-all duration-500">
                                <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                                    <i class="fas fa-cog text-green-400 mr-2"></i>
                                    Acciones de Supervisor
                                </h3>
                                <div class="space-y-3">
                                    <!-- Formulario para Aprobar -->
                                    <form id="formAprobar{{ $solicitud->id }}" method="POST"
                                        action="{{ route('solicitudes.aprobar', $solicitud) }}">
                                        @csrf
                                        <button type="button" onclick="aprobarConComentarios({{ $solicitud->id }})"
                                            class="w-full px-4 py-3 bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 border border-green-500/30 rounded-xl hover:from-green-500/30 hover:to-emerald-500/30 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                            <i
                                                class="fas fa-check group-hover:scale-110 transition-transform duration-300"></i>
                                            <span>Aprobar Solicitud</span>
                                        </button>
                                    </form>

                                    <!-- Formulario para Rechazar -->
                                    <form id="formRechazar{{ $solicitud->id }}" method="POST"
                                        action="{{ route('solicitudes.rechazar', $solicitud) }}">
                                        @csrf
                                        <button type="button" onclick="rechazarConComentarios({{ $solicitud->id }})"
                                            class="w-full px-4 py-3 bg-gradient-to-r from-red-500/20 to-pink-500/20 text-red-300 border border-red-500/30 rounded-xl hover:from-red-500/30 hover:to-pink-500/30 transition-all duration-300 flex items-center justify-center space-x-2 group">
                                            <i
                                                class="fas fa-times group-hover:scale-110 transition-transform duration-300"></i>
                                            <span>Rechazar Solicitud</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Botones de Navegación Mejorados -->
                    <div class="flex justify-end space-x-4 mt-12 pt-8 border-t border-slate-700/50">
                        <a href="{{ route('solicitudes.historial') }}"
                            class="px-8 py-3 bg-slate-800/50 text-slate-300 border border-slate-600 rounded-xl hover:bg-slate-700/50 hover:border-slate-500 transition-all duration-300 flex items-center space-x-2 group">
                            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform duration-300"></i>
                            <span>Volver al Historial</span>
                        </a>
                    </div>
                </div>
            </div>
        @endsection
        @section('scripts')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                function aprobarConComentarios(solicitudId) {
                    Swal.fire({
                        title: '¿Aprobar Solicitud?',
                        text: "Esta acción no se puede deshacer",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#10b981',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, aprobar',
                        cancelButtonText: 'Cancelar',
                        background: '#1f2937',
                        color: '#f9fafb',
                        input: 'textarea',
                        inputLabel: 'Comentarios (opcional)',
                        inputPlaceholder: 'Ingresa tus comentarios...',
                        inputAttributes: {
                            'aria-label': 'Ingresa tus comentarios'
                        },
                        showCancelButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('formAprobar' + solicitudId);
                            if (result.value) {
                                // Agregar campo de comentarios al formulario
                                const input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'comentarios_supervisor';
                                input.value = result.value;
                                form.appendChild(input);
                            }
                            form.submit();
                        }
                    });
                }

                function rechazarConComentarios(solicitudId) {
                    Swal.fire({
                        title: '¿Rechazar Solicitud?',
                        text: "Esta acción no se puede deshacer",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, rechazar',
                        cancelButtonText: 'Cancelar',
                        background: '#1f2937',
                        color: '#f9fafb',
                        input: 'textarea',
                        inputLabel: 'Comentarios (obligatorios)',
                        inputPlaceholder: 'Explica por qué rechazas esta solicitud...',
                        inputAttributes: {
                            'aria-label': 'Ingresa tus comentarios'
                        },
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Debes proporcionar una razón para el rechazo';
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('formRechazar' + solicitudId);
                            // Agregar campo de comentarios al formulario
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'comentarios_supervisor';
                            input.value = result.value;
                            form.appendChild(input);
                            form.submit();
                        }
                    });
                }

                function cancelarSolicitud(solicitudId) {
                    Swal.fire({
                        title: '¿Cancelar Solicitud?',
                        text: "Esta acción no se puede deshacer",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#f59e0b',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, cancelar',
                        cancelButtonText: 'Volver',
                        background: '#1f2937',
                        color: '#f9fafb'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `/solicitudes/${solicitudId}/cancelar`;
                        }
                    });
                }

                // Efectos de hover mejorados
                document.addEventListener('DOMContentLoaded', function() {
                    const cards = document.querySelectorAll('.group');
                    cards.forEach(card => {
                        card.addEventListener('mouseenter', function() {
                            this.style.transform = 'translateY(-2px)';
                        });
                        card.addEventListener('mouseleave', function() {
                            this.style.transform = 'translateY(0)';
                        });
                    });
                });
            </script>
        @endsection
