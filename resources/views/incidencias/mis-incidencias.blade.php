@extends('layouts.dashboard')

@section('title', 'Mis Incidencias - Incidex')
@section('page-title', 'Mis Incidencias')
@section('page-description', 'Lista de todas las incidencias que has reportado')

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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Mis Incidencias</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header con Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">Total</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $incidencias->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-primary-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-list text-primary-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">Pendientes</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $incidencias->where('estado', 'pendiente')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">En Proceso</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $incidencias->where('estado', 'en_proceso')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-cog text-blue-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">Resueltas</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $incidencias->where('estado', 'resuelta')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón Nueva Incidencia -->
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-white">Todas mis incidencias</h3>
            <a href="{{ route('incidencias.create') }}"
               class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center space-x-2">
                <i class="fas fa-plus-circle"></i>
                <span>Nueva Incidencia</span>
            </a>
        </div>

        <!-- Tabla de Incidencias -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
            @if($incidencias->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="text-left text-surface-400 text-sm border-b border-surface-700">
                            <th class="pb-4 font-medium">ID</th>
                            <th class="pb-4 font-medium">Título</th>
                            <th class="pb-4 font-medium">Categoría</th>
                            <th class="pb-4 font-medium">Prioridad</th>
                            <th class="pb-4 font-medium">Estado</th>
                            <th class="pb-4 font-medium">Fecha</th>
                            <th class="pb-4 font-medium">Técnico</th>
                            <th class="pb-4 font-medium">Acciones</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-700">
                        @foreach($incidencias as $incidencia)
                            <tr class="text-sm hover:bg-surface-800/50 transition duration-200">
                                <td class="py-4 text-surface-300 font-mono">
                                    #{{ str_pad($incidencia->id_incidencias, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-4">
                                    <div class="max-w-xs">
                                        <p class="text-white font-medium truncate" title="{{ $incidencia->titulo }}">
                                            {{ $incidencia->titulo }}
                                        </p>
                                        <p class="text-surface-400 text-xs mt-1 truncate">
                                            {{ Str::limit($incidencia->descripcion, 50) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="py-4 text-surface-300 capitalize">
                                    {{ $incidencia->categoria }}
                                </td>
                                <td class="py-4">
                                    @php
                                        $prioridadColors = [
                                            'baja' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                            'media' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                            'alta' => 'bg-orange-500/20 text-orange-400 border-orange-500/30',
                                            'critica' => 'bg-red-500/20 text-red-400 border-red-500/30'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $prioridadColors[$incidencia->prioridad] }} capitalize">
                                    {{ $incidencia->prioridad }}
                                </span>
                                </td>
                                <td class="py-4">
                                    @php
                                        $estadoColors = [
                                            'pendiente' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                                            'asignada' => 'bg-blue-500/20 text-blue-400 border-blue-500/30',
                                            'en_proceso' => 'bg-purple-500/20 text-purple-400 border-purple-500/30',
                                            'resuelta' => 'bg-green-500/20 text-green-400 border-green-500/30',
                                            'cerrada' => 'bg-gray-500/20 text-gray-400 border-gray-500/30'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-medium border {{ $estadoColors[$incidencia->estado] }} capitalize">
                                    {{ str_replace('_', ' ', $incidencia->estado) }}
                                </span>
                                </td>
                                <td class="py-4 text-surface-300">
                                    <div class="flex flex-col">
                                        <span class="text-xs">{{ $incidencia->created_at->format('d/m/Y') }}</span>
                                        <span class="text-xs text-surface-500">{{ $incidencia->created_at->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td class="py-4 text-surface-300">
                                    @if($incidencia->tecnico)
                                        <div class="flex items-center space-x-2">
                                            <div class="w-6 h-6 bg-primary-500/20 rounded-full flex items-center justify-center">
                                            <span class="text-primary-400 text-xs font-bold">
                                                {{ strtoupper(substr($incidencia->tecnico->nombre, 0, 1)) }}
                                            </span>
                                            </div>
                                            <span class="text-sm">{{ $incidencia->tecnico->nombre }}</span>
                                        </div>
                                    @else
                                        <span class="text-surface-500 text-sm">Sin asignar</span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('incidencias.show', $incidencia) }}"
                                           class="p-2 text-surface-400 hover:text-primary-400 transition duration-200"
                                           title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($incidencia->puedeSerEditadaPor(Auth::user()))
                                            <a href="{{ route('incidencias.edit', $incidencia) }}"
                                               class="p-2 text-surface-400 hover:text-yellow-400 transition duration-200"
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif

                                        @if($incidencia->estado === 'pendiente')
                                            <button class="p-2 text-surface-400 hover:text-red-400 transition duration-200"
                                                    onclick="cancelarIncidencia({{ $incidencia->id_incidencias }})"
                                                    title="Cancelar">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Paginación (si la agregas después) -->
                {{-- <div class="mt-6">
                    {{ $incidencias->links() }}
                </div> --}}
            @else
                <!-- Estado vacío -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-surface-800/50 rounded-full flex items-center justify-center">
                        <i class="fas fa-inbox text-surface-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">No hay incidencias</h3>
                    <p class="text-surface-400 mb-6">Aún no has reportado ninguna incidencia.</p>
                    <a href="{{ route('incidencias.create') }}"
                       class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center space-x-2 mx-auto w-fit">
                        <i class="fas fa-plus-circle"></i>
                        <span>Reportar Primera Incidencia</span>
                    </a>
                </div>
            @endif
        </div>

        <!-- Filtros (opcional para futuras mejoras) -->
        <div class="mt-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <span class="text-surface-400 text-sm">Filtrar por:</span>
                <select class="bg-surface-800 border border-surface-600 rounded-lg px-3 py-2 text-surface-300 text-sm focus:outline-none focus:border-primary-500">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="asignada">Asignada</option>
                    <option value="en_proceso">En Proceso</option>
                    <option value="resuelta">Resuelta</option>
                    <option value="cerrada">Cerrada</option>
                </select>
                <select class="bg-surface-800 border border-surface-600 rounded-lg px-3 py-2 text-surface-300 text-sm focus:outline-none focus:border-primary-500">
                    <option value="">Todas las prioridades</option>
                    <option value="baja">Baja</option>
                    <option value="media">Media</option>
                    <option value="alta">Alta</option>
                    <option value="critica">Crítica</option>
                </select>
            </div>
            <div class="text-surface-400 text-sm">
                Mostrando {{ $incidencias->count() }} incidencia(s)
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function cancelarIncidencia(incidenciaId) {
            if (confirm('¿Estás seguro de que deseas cancelar esta incidencia?')) {
                // Aquí puedes agregar la lógica para cancelar la incidencia
                console.log('Cancelar incidencia:', incidenciaId);
                // Ejemplo: fetch(`/incidencias/${incidenciaId}/cancelar`, { method: 'POST' })
            }
        }

        // Filtros interactivos (mejora futura)
        document.addEventListener('DOMContentLoaded', function() {
            const estadoFilter = document.querySelector('select:first-of-type');
            const prioridadFilter = document.querySelector('select:last-of-type');

            function aplicarFiltros() {
                const estado = estadoFilter.value;
                const prioridad = prioridadFilter.value;

                // Aquí puedes implementar la lógica de filtrado
                console.log('Filtrar por:', { estado, prioridad });
            }

            estadoFilter.addEventListener('change', aplicarFiltros);
            prioridadFilter.addEventListener('change', aplicarFiltros);
        });
    </script>
@endsection
