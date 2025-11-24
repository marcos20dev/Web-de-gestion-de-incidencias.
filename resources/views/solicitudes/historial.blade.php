@extends('layouts.dashboard')

@section('title', 'Historial de Solicitudes - Incidex')

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
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-slate-600 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-green-400">Historial de Solicitudes</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-slate-900/80 to-green-900/20 rounded-2xl shadow-2xl overflow-hidden border border-slate-700/50 backdrop-blur-xl p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 p-4 rounded-2xl border border-green-500/30 shadow-lg">
                        <i class="fas fa-history text-green-400 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-white mb-2">Historial de Solicitudes</h1>
                        <p class="text-slate-400">Lista completa de todas las solicitudes de aprobación</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm">Total</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $solicitudes->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-list text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm">Pendientes</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['pendientes'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm">Aprobadas</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['aprobadas'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-400 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl p-6 border border-slate-700/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm">Rechazadas</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['rechazadas'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Solicitudes -->
    <div class="bg-slate-800/50 backdrop-blur-xl rounded-2xl shadow-xl p-6 border border-slate-700/50">
        @if($solicitudes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-slate-400 text-sm border-b border-slate-700">
                            <th class="pb-4 font-medium">ID</th>
                            <th class="pb-4 font-medium">Título</th>
                            <th class="pb-4 font-medium">Incidencia</th>
                            <th class="pb-4 font-medium">Tipo</th>
                            <th class="pb-4 font-medium">Técnico</th>
                            <th class="pb-4 font-medium">Estado</th>
                            <th class="pb-4 font-medium">Fecha</th>
                            <th class="pb-4 font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @foreach($solicitudes as $solicitud)
                        <tr class="text-sm hover:bg-slate-700/50 transition duration-200">
                            <td class="py-4 text-slate-300 font-mono">
                                #{{ str_pad($solicitud->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-4">
                                <div class="max-w-xs">
                                    <p class="text-white font-medium truncate" title="{{ $solicitud->titulo }}">
                                        {{ $solicitud->titulo }}
                                    </p>
                                    <p class="text-slate-400 text-xs mt-1 truncate">
                                        {{ Str::limit($solicitud->descripcion, 50) }}
                                    </p>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-slate-300 font-mono">#{{ $solicitud->incidencia->id_incidencias }}</span>
                                    <span class="text-slate-400 text-xs">({{ Str::limit($solicitud->incidencia->titulo, 30) }})</span>
                                </div>
                            </td>
                            <td class="py-4">
                                @php
                                    $tipoColors = [
                                        'aprobacion' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                        'recursos' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                        'asistencia' => 'bg-orange-500/20 text-orange-400 border-orange-500/30',
                                        'otros' => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                    ];
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-medium border {{ $tipoColors[$solicitud->tipo] }}">
                                    {{ $solicitud->tipo_texto }}
                                </span>
                            </td>
                            <td class="py-4 text-slate-300">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-green-500/20 rounded-full flex items-center justify-center">
                                        <span class="text-green-400 text-xs font-bold">
                                            {{ strtoupper(substr($solicitud->tecnico->nombre, 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-sm">{{ $solicitud->tecnico->nombre }}</span>
                                </div>
                            </td>
                            <td class="py-4">
                                @php
                                    $estadoColors = [
                                        'pendiente' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                        'aprobada' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                        'rechazada' => 'bg-red-500/20 text-red-400 border-red-500/30',
                                        'cancelada' => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $estadoColors[$solicitud->estado] }} capitalize">
                                    {{ $solicitud->estado }}
                                </span>
                            </td>
                            <td class="py-4 text-slate-300">
                                <div class="flex flex-col">
                                    <span class="text-xs">{{ $solicitud->created_at->format('d/m/Y') }}</span>
                                    <span class="text-xs text-slate-500">{{ $solicitud->created_at->format('H:i') }}</span>
                                </div>
                            </td>
                            <td class="py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('solicitudes.show', $solicitud) }}"
                                       class="p-2 text-slate-400 hover:text-green-400 transition duration-200"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-6">
                {{ $solicitudes->links() }}
            </div>
        @else
            <!-- Estado vacío -->
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto mb-4 bg-slate-700/50 rounded-full flex items-center justify-center">
                    <i class="fas fa-inbox text-slate-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">No hay solicitudes</h3>
                <p class="text-slate-400 mb-6">No se han encontrado solicitudes en el sistema.</p>
            </div>
        @endif
    </div>
</div>
@endsection
