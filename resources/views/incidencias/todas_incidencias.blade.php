@extends('layouts.dashboard')

@section('title', 'Todas las Incidencias - Incidex')
@section('page-title', 'Gestión de Incidencias')
@section('page-description', 'Panel de administración de todas las incidencias del sistema')

@section('content')
<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

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
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-slate-600 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-green-400">Todas las Incidencias</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header con Estadísticas -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-slate-900/80 to-green-900/20 rounded-2xl shadow-2xl overflow-hidden border border-slate-700/50 backdrop-blur-xl">
            <div class="px-8 py-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center space-x-4 mb-6 lg:mb-0">
                        <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 p-4 rounded-2xl border border-green-500/30 shadow-lg">
                            <i class="fas fa-tasks text-green-400 text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-white">Gestión de Incidencias</h1>
                            <p class="text-slate-400 mt-1">Administra y supervisa todas las incidencias del sistema</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="bg-slate-800/50 backdrop-blur-sm rounded-xl px-4 py-2 border border-slate-700">
                            <span class="text-white font-semibold">{{ $incidencias->count() }} incidencias</span>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas Generales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:border-green-500/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium">Total Incidencias</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $totalIncidencias ?? 0 }}</p>
                    <p class="text-xs text-slate-500 mt-1">Todas las incidencias</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center border border-green-500/30 group-hover:bg-green-500/30 transition-all">
                    <i class="fas fa-list text-green-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:border-yellow-500/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium">Pendientes</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $pendientes ?? 0 }}</p>
                    <p class="text-xs text-slate-500 mt-1">Esperando acción</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center border border-yellow-500/30 group-hover:bg-yellow-500/30 transition-all">
                    <i class="fas fa-clock text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:border-blue-500/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium">En Proceso</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $enProceso ?? 0 }}</p>
                    <p class="text-xs text-slate-500 mt-1">En resolución</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center border border-blue-500/30 group-hover:bg-blue-500/30 transition-all">
                    <i class="fas fa-cogs text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:border-green-500/30 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm font-medium">Resueltas</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $resueltas ?? 0 }}</p>
                    <p class="text-xs text-slate-500 mt-1">Completadas</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center border border-green-500/30 group-hover:bg-green-500/30 transition-all">
                    <i class="fas fa-check-circle text-green-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros y Búsqueda Avanzados -->
    <div class="mb-8 bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-slate-700/50">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="flex-1">
                <div class="relative max-w-md group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-500 group-focus-within:text-green-400 transition-colors"></i>
                    </div>
                    <input type="text"
                           class="w-full pl-12 pr-4 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 hover:border-green-500/50"
                           placeholder="Buscar en todas las incidencias...">
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <select class="bg-slate-700/50 border border-slate-600 rounded-xl py-3 px-4 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 cursor-pointer hover:border-green-500">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="asignada">Asignada</option>
                    <option value="en_proceso">En Proceso</option>
                    <option value="resuelta">Resuelta</option>
                    <option value="cerrada">Cerrada</option>
                </select>
                <select class="bg-slate-700/50 border border-slate-600 rounded-xl py-3 px-4 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 cursor-pointer hover:border-green-500">
                    <option value="">Todas las prioridades</option>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                    <option value="critica">Crítica</option>
                </select>
                <select class="bg-slate-700/50 border border-slate-600 rounded-xl py-3 px-4 text-white text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 cursor-pointer hover:border-green-500">
                    <option value="">Todos los técnicos</option>
                    <!-- Opciones de técnicos -->
                </select>
            </div>
        </div>
    </div>

    <!-- Tabla de Todas las Incidencias -->
    <div class="bg-slate-800/50 backdrop-blur-xl shadow-2xl rounded-3xl overflow-hidden border border-slate-700/50">
        @if($incidencias->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-slate-700/50">
                    <thead class="bg-gradient-to-r from-slate-900 to-slate-800 border-b border-slate-700">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider cursor-pointer hover:text-green-300 transition-colors">
                                <div class="flex items-center space-x-1">
                                    <span>ID</span>
                                    <i class="fas fa-sort text-xs opacity-50"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider">Título</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider">Usuario</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider">Técnico</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider">Prioridad</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider">Categoría</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-green-400 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-green-400 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @foreach($incidencias as $incidencia)
                            <tr class="hover:bg-slate-700/30 transition-all duration-300 group border-l-4 border-l-green-500/0 hover:border-l-green-500">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-green-400 bg-slate-700/50 px-3 py-1 rounded-lg">
                                        #{{ $incidencia->id_incidencias ?? $incidencia->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-green-500/20 to-emerald-500/20 rounded-xl flex items-center justify-center border border-green-500/30 group-hover:from-green-500/40 group-hover:to-emerald-500/40 transition-all">
                                            <i class="fas fa-ticket-alt text-green-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-white truncate max-w-xs">
                                                {{ $incidencia->titulo }}
                                            </div>
                                            <div class="text-xs text-slate-400 truncate max-w-xs">
                                                {{ Str::limit($incidencia->descripcion, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-br from-green-500/30 to-emerald-500/30 rounded-full flex items-center justify-center border border-green-500/30 font-bold text-green-300 text-xs">
                                            {{ substr($incidencia->usuario->name ?? 'N/A', 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="text-sm text-slate-300 block">
{{ $incidencia->usuario ? $incidencia->usuario->nombre . ' ' . $incidencia->usuario->apellido_paterno : 'N/A' }}
                                            </span>
                                            <span class="text-xs text-slate-500">
                                                {{ $incidencia->usuario->email ?? '' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($incidencia->tecnico)
                                        <div class="flex items-center space-x-2">
                                            <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-br from-green-500/30 to-emerald-500/30 rounded-full flex items-center justify-center border border-green-500/30 font-bold text-green-300 text-xs">
                                                {{ substr($incidencia->tecnico->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <span class="text-sm text-slate-300 block">
                                                    {{ $incidencia->tecnico->name }}
                                                </span>
                                                <span class="text-xs text-slate-500">
                                                    Técnico asignado
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center space-x-2">
                                            <div class="flex-shrink-0 h-8 w-8 bg-slate-700 rounded-full flex items-center justify-center border border-slate-600">
                                                <i class="fas fa-user-slash text-slate-500 text-xs"></i>
                                            </div>
                                            <span class="text-sm text-slate-500 italic">
                                                Sin asignar
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $prioridadClasses = [
                                            'baja' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                            'media' => 'bg-yellow-500/20 text-yellow-300 border border-yellow-500/30',
                                            'alta' => 'bg-orange-500/20 text-orange-300 border border-orange-500/30',
                                            'critica' => 'bg-red-500/20 text-red-300 border border-red-500/30'
                                        ];
                                        $prioridadClass = $prioridadClasses[$incidencia->prioridad] ?? 'bg-slate-700 text-slate-300 border border-slate-600';
                                        $prioridadIcon = [
                                            'baja' => 'fas fa-arrow-down',
                                            'media' => 'fas fa-minus',
                                            'alta' => 'fas fa-arrow-up',
                                            'critica' => 'fas fa-exclamation-triangle'
                                        ];
                                        $prioridadIconClass = $prioridadIcon[$incidencia->prioridad] ?? 'fas fa-circle';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold {{ $prioridadClass }}">
                                        <i class="{{ $prioridadIconClass }} mr-1 text-xs"></i>
                                        {{ ucfirst($incidencia->prioridad) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $estadoClasses = [
                                            'pendiente' => 'bg-slate-600/50 text-slate-300 border border-slate-500',
                                            'asignada' => 'bg-blue-500/20 text-blue-300 border border-blue-500/30',
                                            'en_proceso' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                            'resuelta' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                            'cerrada' => 'bg-green-500/20 text-green-300 border border-green-500/30'
                                        ];
                                        $estadoClass = $estadoClasses[$incidencia->estado] ?? 'bg-slate-700 text-slate-300 border border-slate-600';
                                        $estadoIcon = [
                                            'pendiente' => 'far fa-clock',
                                            'asignada' => 'fas fa-user-check',
                                            'en_proceso' => 'fas fa-cogs',
                                            'resuelta' => 'fas fa-check-circle',
                                            'cerrada' => 'fas fa-archive'
                                        ];
                                        $estadoIconClass = $estadoIcon[$incidencia->estado] ?? 'fas fa-circle';
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold {{ $estadoClass }}">
                                        <i class="{{ $estadoIconClass }} mr-1 text-xs"></i>
                                        {{ ucfirst(str_replace('_', ' ', $incidencia->estado)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-slate-700/50 text-slate-300 border border-slate-600">
                                        <i class="fas fa-tag mr-1 text-xs text-slate-400"></i>
                                        {{ $incidencia->categoria }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm">
                                        <div class="text-slate-300 font-medium">{{ $incidencia->created_at->format('d/m/Y') }}</div>
                                        <div class="text-xs text-slate-500">{{ $incidencia->created_at->format('H:i') }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('incidencias.show', $incidencia) }}"
                                           class="p-2 rounded-lg bg-green-500/20 text-green-400 border border-green-500/30 hover:bg-green-500/40 hover:shadow-lg hover:shadow-green-500/20 transition-all duration-300 transform hover:scale-110"
                                           title="Ver detalles">
                                            <i class="fas fa-eye w-4 h-4"></i>
                                        </a>
                                        @can('update', $incidencia)
                                            <a href="{{ route('incidencias.edit', $incidencia) }}"
                                               class="p-2 rounded-lg bg-amber-500/20 text-amber-400 border border-amber-500/30 hover:bg-amber-500/40 hover:shadow-lg hover:shadow-amber-500/20 transition-all duration-300 transform hover:scale-110"
                                               title="Editar incidencia">
                                                <i class="fas fa-edit w-4 h-4"></i>
                                            </a>
                                        @endcan
                                        @can('delete', $incidencia)
                                            <form action="{{ route('incidencias.destroy', $incidencia) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-2 rounded-lg bg-red-500/20 text-red-400 border border-red-500/30 hover:bg-red-500/40 hover:shadow-lg hover:shadow-red-500/20 transition-all duration-300 transform hover:scale-110"
                                                        title="Eliminar incidencia"
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta incidencia?')">
                                                    <i class="fas fa-trash w-4 h-4"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-20">
                <div class="mx-auto w-40 h-40 bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl flex items-center justify-center mb-8 shadow-2xl border border-slate-700">
                    <i class="fas fa-inbox text-slate-600 text-6xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-3">No hay incidencias en el sistema</h3>
                <p class="text-slate-400 max-w-md mx-auto mb-8 font-medium">
                    No se han registrado incidencias en el sistema todavía.
                </p>

            </div>
        @endif

        <!-- Paginación -->
        @if($incidencias->hasPages())
            <div class="bg-slate-900/50 backdrop-blur px-6 py-4 border-t border-slate-700 rounded-b-3xl">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-slate-400">
                        Mostrando <span class="text-green-400 font-bold">{{ $incidencias->firstItem() ?? 0 }} - {{ $incidencias->lastItem() ?? 0 }}</span> de <span class="text-green-400 font-bold">{{ $incidencias->total() }}</span> incidencias
                    </div>
                    <div class="flex justify-center">
                        {{ $incidencias->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
