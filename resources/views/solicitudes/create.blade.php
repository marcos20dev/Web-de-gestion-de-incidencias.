@extends('layouts.dashboard')

@section('title', 'Nueva Solicitud - Incidex')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Breadcrumbs -->
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-slate-600 mx-2"></i>
                        <a href="{{ route('incidencias.asignadas') }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">
                            Mis Incidencias Asignadas
                        </a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-slate-600 mx-2"></i>
                        <a href="{{ route('incidencias.asignadas.show', $incidencia) }}" class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-200">
                            Incidencia #{{ $incidencia->id_incidencias }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-slate-600 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-green-400">Nueva Solicitud</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-slate-900/80 to-green-900/20 rounded-2xl shadow-2xl overflow-hidden border border-slate-700/50 backdrop-blur-xl p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center space-x-4 mb-4 lg:mb-0">
                    <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 p-4 rounded-2xl border border-green-500/30 shadow-lg">
                        <i class="fas fa-handshake text-green-400 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">Nueva Solicitud de Aprobación</h1>
                        <p class="text-slate-400">Incidencia: <span class="text-white font-medium">#{{ $incidencia->id_incidencias }} - {{ $incidencia->titulo }}</span></p>
                    </div>
                </div>
                <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700/50">
                    <div class="flex flex-wrap gap-4 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-slate-300">Estado:</span>
                            <span class="text-green-400 font-medium">Activa</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-slate-400"></i>
                            <span class="text-slate-300">Fecha:</span>
                            <span class="text-white">{{ now()->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario -->
    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-slate-700/50">
        <form action="{{ route('solicitudes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="incidencia_id" value="{{ $incidencia->id_incidencias }}">

            <!-- Sección Horizontal - Información Principal -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
                <!-- Tipo de Solicitud -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-tag mr-2 text-green-400"></i>Tipo de Solicitud *
                    </label>
                    <select name="tipo" required class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200 appearance-none">
                        <option value="">Selecciona un tipo</option>
                        <option value="aprobacion">Aprobación de Procedimiento</option>
                        <option value="recursos">Solicitud de Recursos/Materiales</option>
                        <option value="asistencia">Solicitud de Asistencia Técnica</option>
                        <option value="otros">Otro Tipo de Solicitud</option>
                    </select>
                </div>

                <!-- Supervisor -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-user-tie mr-2 text-green-400"></i>Supervisor Destinatario *
                    </label>
                    <select name="supervisor_id" required class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200 appearance-none">
                        <option value="">Selecciona un supervisor</option>
                        @foreach($supervisores as $supervisor)
                            <option value="{{ $supervisor->id }}">
                                {{ $supervisor->nombre }} {{ $supervisor->apellido_paterno }} - {{ $supervisor->rol->nombre ?? 'Supervisor' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Prioridad -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-flag mr-2 text-green-400"></i>Prioridad *
                    </label>
                    <select name="prioridad" required class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200 appearance-none">
                        <option value="baja">Baja</option>
                        <option value="media" selected>Media</option>
                        <option value="alta">Alta</option>
                        <option value="urgente">Urgente</option>
                    </select>
                </div>
            </div>

            <!-- Título -->
            <div class="mb-6 form-group">
                <label class="block text-sm font-medium text-slate-300 mb-2">
                    <i class="fas fa-heading mr-2 text-green-400"></i>Título de la Solicitud *
                </label>
                <input type="text" name="titulo" required
                       class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200"
                       placeholder="Ej: Solicitud de compra de repuestos, Aprobación para procedimiento especial, etc.">
            </div>

            <!-- Descripción y Justificación en Horizontal -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Descripción -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-align-left mr-2 text-green-400"></i>Descripción Detallada *
                    </label>
                    <textarea name="descripcion" rows="5" required
                              class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200"
                              placeholder="Describe en detalle qué necesitas, qué problema has encontrado, o qué procedimiento necesitas aprobar..."></textarea>
                </div>

                <!-- Justificación -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-clipboard-check mr-2 text-green-400"></i>Justificación *
                    </label>
                    <textarea name="justificacion" rows="5" required
                              class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200"
                              placeholder="Explica por qué es necesaria esta solicitud y cómo ayudará a resolver la incidencia..."></textarea>
                </div>
            </div>

            <!-- Recursos y Costo en Horizontal -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-tools mr-2 text-green-400"></i>Recursos/Materiales Solicitados
                    </label>
                    <textarea name="recursos_solicitados" rows="4"
                              class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200"
                              placeholder="Lista de materiales, herramientas, o recursos específicos que necesitas..."></textarea>
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-pen-sign mr-2 text-green-400"></i>Costo Estimado (opcional)
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">S/ </span>
                        <input type="number" name="costo_estimado" step="0.01" min="0"
                               class="w-full bg-slate-700/50 border border-slate-600 rounded-xl pl-8 pr-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200"
                               placeholder="0.00">
                    </div>
                    <p class="text-xs text-slate-400 mt-2 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i> Ingresa el costo estimado si aplica
                    </p>
                </div>
            </div>

            <!-- Fechas y Plazo en Horizontal -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-calendar-plus mr-2 text-green-400"></i>Fecha Requerida
                    </label>
                    <input type="date" name="fecha_requerida"
                           class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200">
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-clock mr-2 text-green-400"></i>Plazo Estimado (días)
                    </label>
                    <input type="number" name="plazo_estimado" min="1" max="30"
                           class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200"
                           placeholder="Ej: 5">
                </div>

                <div class="form-group">
                    <label class="block text-sm font-medium text-slate-300 mb-2">
                        <i class="fas fa-file-alt mr-2 text-green-400"></i>Categoría
                    </label>
                    <select name="categoria" class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition duration-200">
                        <option value="tecnica">Técnica</option>
                        <option value="administrativa">Administrativa</option>
                        <option value="operativa">Operativa</option>
                        <option value="logistica">Logística</option>
                        <option value="otra">Otra</option>
                    </select>
                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4 pt-6 border-t border-slate-700">
                <a href="{{ route('incidencias.asignadas.show', $incidencia) }}"
                   class="px-6 py-3 border border-slate-600 text-slate-300 rounded-xl hover:bg-slate-700/50 transition-all duration-200 flex items-center justify-center space-x-2">
                    <i class="fas fa-times"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl font-medium transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center justify-center space-x-2">
                    <i class="fas fa-paper-plane"></i>
                    <span>Enviar Solicitud</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .form-group {
        transition: all 0.3s ease;
    }
    .form-group:focus-within {
        transform: translateY(-2px);
    }
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%234ade80' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
</style>
@endsection
