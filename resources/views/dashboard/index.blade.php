@extends('layouts.dashboard')

@section('title', 'Dashboard - Incidex')
@section('page-title', 'Mi Panel de ' . ucfirst($rolNormalizado))
@section('page-description', 'Resumen de actividades del sistema')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-surface-400 hover:text-white transition duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Mi Panel</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Tarjeta de Bienvenida -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">
                        ¡Bienvenido, {{ $user->nombre }} {{ $user->apellido_paterno }}!
                    </h1>
                    <p class="text-surface-300 capitalize">
                        {{ ucfirst($rolNormalizado) }} - Resumen de actividades
                    </p>
                    <div class="flex items-center space-x-4 mt-4">
                        <div class="flex items-center space-x-2 text-surface-400">
                            <i class="fas fa-user-cog"></i>
                            <span class="text-sm capitalize">{{ ucfirst($rolNormalizado) }}</span>
                        </div>
                        <div class="flex items-center space-x-2 text-surface-400">
                            <i class="fas fa-envelope"></i>
                            <span class="text-sm">{{ $user->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-2xl font-bold">
                        {{ strtoupper(substr($user->nombre, 0, 1)) }}{{ strtoupper(substr($user->apellido_paterno, 0, 1)) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @if($rolNormalizado === 'tecnico')
                <!-- Estadísticas para TÉCNICO -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Incidencias Asignadas</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['incidencias_asignadas'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tools text-blue-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <span class="text-surface-400">En proceso: {{ $estadisticas['en_proceso'] }}</span>
                        <span class="text-surface-400">Pendientes: {{ $estadisticas['pendientes'] }}</span>
                    </div>
                </div>

                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Incidencias Resueltas</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['resueltas'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if ($estadisticas['incidencias_asignadas'] > 0)
                            @php
                                $porcentaje = ($estadisticas['resueltas'] / $estadisticas['incidencias_asignadas']) * 100;
                            @endphp
                            <div class="text-surface-400 text-sm">
                                Tasa de resolución: {{ number_format($porcentaje, 1) }}%
                            </div>
                        @endif
                    </div>
                </div>

                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Mis Solicitudes</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['solicitudes_enviadas'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-handshake text-orange-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-surface-400 text-sm">
                        Pendientes: {{ $estadisticas['solicitudes_pendientes'] }}
                    </div>
                </div>

            @elseif($rolNormalizado === 'supervisor')
                <!-- Estadísticas para SUPERVISOR -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Total Incidencias</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['incidencias_totales'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-tasks text-blue-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <span class="text-surface-400">Pendientes: {{ $estadisticas['incidencias_pendientes'] }}</span>
                        <span class="text-surface-400">En proceso: {{ $estadisticas['incidencias_proceso'] }}</span>
                    </div>
                </div>

                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Incidencias Resueltas</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['incidencias_resueltas'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if ($estadisticas['incidencias_totales'] > 0)
                            @php
                                $porcentaje = ($estadisticas['incidencias_resueltas'] / $estadisticas['incidencias_totales']) * 100;
                            @endphp
                            <div class="text-surface-400 text-sm">
                                Tasa de resolución: {{ number_format($porcentaje, 1) }}%
                            </div>
                        @endif
                    </div>
                </div>

                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Solicitudes Totales</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['solicitudes_totales'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-handshake text-orange-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-surface-400 text-sm">
                        Pendientes: {{ $estadisticas['solicitudes_pendientes'] }}
                    </div>
                </div>

            @elseif($rolNormalizado === 'usuario')
                <!-- Estadísticas para USUARIO -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Mis Incidencias</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['mis_incidencias'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-list text-blue-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-sm">
                        <span class="text-surface-400">Pendientes: {{ $estadisticas['incidencias_pendientes'] }}</span>
                        <span class="text-surface-400">En proceso: {{ $estadisticas['incidencias_proceso'] }}</span>
                    </div>
                </div>

                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Incidencias Resueltas</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['incidencias_resueltas'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        @if ($estadisticas['mis_incidencias'] > 0)
                            @php
                                $porcentaje = ($estadisticas['incidencias_resueltas'] / $estadisticas['mis_incidencias']) * 100;
                            @endphp
                            <div class="text-surface-400 text-sm">
                                Tasa de resolución: {{ number_format($porcentaje, 1) }}%
                            </div>
                        @endif
                    </div>
                </div>

                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-surface-400 text-sm">Incidencias Urgentes</p>
                            <p class="text-3xl font-bold text-white mt-1">{{ $estadisticas['incidencias_urgentes'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-surface-400 text-sm">
                        Prioridad alta
                    </div>
                </div>
            @endif
        </div>

        <!-- 📈 GRÁFICOS SECTION -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white mb-6">📊 Análisis Visual</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

                <!-- Estado de Incidencias -->
                @if(isset($datosGraficos['estado']))
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-bold text-white mb-4">Estado de Incidencias</h3>
                    <div style="height: 300px;">
                        <canvas id="estadoChart"></canvas>
                    </div>
                </div>
                @endif

                <!-- Prioridad -->
                @if(isset($datosGraficos['prioridad']))
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-bold text-white mb-4">Distribución por Prioridad</h3>
                    <div style="height: 300px;">
                        <canvas id="prioridadChart"></canvas>
                    </div>
                </div>
                @endif

                <!-- Tendencia -->
                @if(isset($datosGraficos['tendencia']))
                <div class="glass-effect rounded-2xl p-6 border border-surface-700 lg:col-span-2">
                    <h3 class="text-lg font-bold text-white mb-4">Tendencia (Últimos 7 días)</h3>
                    <div style="height: 300px;">
                        <canvas id="tendenciaChart"></canvas>
                    </div>
                </div>
                @endif

                <!-- Categorías (Solo Supervisor) -->
                @if($rolNormalizado === 'supervisor' && isset($datosGraficos['categorias']))
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-bold text-white mb-4">Categorías Más Comunes</h3>
                    <div style="height: 300px;">
                        <canvas id="categoriasChart"></canvas>
                    </div>
                </div>
                @endif

                <!-- Desempeño Técnicos (Solo Supervisor) -->
                @if($rolNormalizado === 'supervisor' && isset($datosGraficos['tecnicos']))
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-bold text-white mb-4">Desempeño por Técnico</h3>
                    <div style="height: 300px;">
                        <canvas id="tecnicosChart"></canvas>
                    </div>
                </div>
                @endif

                <!-- Solicitudes -->
                @if(isset($datosGraficos['solicitudes']))
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <h3 class="text-lg font-bold text-white mb-4">Estado de Solicitudes</h3>
                    <div style="height: 300px;">
                        <canvas id="solicitudesChart"></canvas>
                    </div>
                </div>
                @endif

            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-8">
            <h3 class="text-lg font-bold text-white mb-6">Acciones Rápidas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($accionesRapidas as $accion)
                    <a href="{{ $accion['ruta'] }}"
                        class="glass-effect p-6 rounded-xl border border-surface-700 hover:border-{{ $accion['color'] }}-500 transition-all duration-300 text-left group hover:transform hover:scale-105">
                        <div
                            class="w-12 h-12 bg-{{ $accion['color'] }}-500/20 rounded-lg flex items-center justify-center mb-4 group-hover:bg-{{ $accion['color'] }}-500/30 transition-colors duration-300">
                            <i class="{{ $accion['icono'] }} text-{{ $accion['color'] }}-400 text-xl"></i>
                        </div>
                        <h4 class="font-semibold text-white mb-2">{{ $accion['titulo'] }}</h4>
                        <p class="text-surface-400 text-sm leading-relaxed">{{ $accion['descripcion'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Incidencias Recientes -->
        @if (!empty($incidenciasRecientes) && $incidenciasRecientes->count() > 0)
            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <h3 class="text-lg font-bold text-white mb-6">
                    @if($rolNormalizado === 'supervisor')
                        Incidencias Recientes del Sistema
                    @elseif($rolNormalizado === 'usuario')
                        Mis Incidencias Recientes
                    @else
                        Mis Incidencias Recientes
                    @endif
                </h3>
                <div class="space-y-4">
                    @foreach ($incidenciasRecientes as $incidencia)
                        <div class="flex items-center justify-between p-4 bg-surface-800/50 rounded-xl border border-surface-700">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-{{ $incidencia->prioridad == 'alta' ? 'red' : ($incidencia->prioridad == 'media' ? 'yellow' : 'green') }}-500/20 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-exclamation-circle text-{{ $incidencia->prioridad == 'alta' ? 'red' : ($incidencia->prioridad == 'media' ? 'yellow' : 'green') }}-400"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white text-sm">{{ Str::limit($incidencia->titulo, 50) }}</h4>
                                    <p class="text-surface-400 text-xs">
                                        {{ $incidencia->categoria }} • {{ $incidencia->created_at->format('d/m/Y') }}
                                        @if($rolNormalizado === 'supervisor' && $incidencia->tecnico)
                                            • Técnico: {{ $incidencia->tecnico->nombre }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-{{ $incidencia->estado == 'pendiente' ? 'yellow' : ($incidencia->estado == 'en_proceso' ? 'blue' : 'green') }}-500/20 text-{{ $incidencia->estado == 'pendiente' ? 'yellow' : ($incidencia->estado == 'en_proceso' ? 'blue' : 'green') }}-400 border border-{{ $incidencia->estado == 'pendiente' ? 'yellow' : ($incidencia->estado == 'en_proceso' ? 'blue' : 'green') }}-500/30 capitalize">
                                    {{ str_replace('_', ' ', $incidencia->estado) }}
                                </span>
                                <a href="{{
                                    $rolNormalizado === 'supervisor' ? route('incidencias.show', $incidencia->id_incidencias) :
                                    ($rolNormalizado === 'usuario' ? route('incidencias.mis.show', $incidencia->id_incidencias) :
                                    route('incidencias.asignadas.show', $incidencia->id_incidencias))
                                }}"
                                    class="text-surface-400 hover:text-blue-400 transition duration-200">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6 text-center">
                    @if($rolNormalizado === 'supervisor')
                        <a href="{{ route('incidencias.general') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-xl hover:bg-blue-500/30 transition duration-200">
                            <i class="fas fa-list mr-2"></i>
                            Ver todas las incidencias
                        </a>
                    @elseif($rolNormalizado === 'usuario')
                        <a href="{{ route('incidencias.mis') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-xl hover:bg-blue-500/30 transition duration-200">
                            <i class="fas fa-list mr-2"></i>
                            Ver todas mis incidencias
                        </a>
                    @else
                        <a href="{{ route('incidencias.asignadas') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500/20 text-blue-400 border border-blue-500/30 rounded-xl hover:bg-blue-500/30 transition duration-200">
                            <i class="fas fa-list mr-2"></i>
                            Ver todas mis incidencias
                        </a>
                    @endif
                </div>
            </div>
        @else
            <div class="glass-effect rounded-2xl p-8 border border-surface-700 text-center">
                <div class="w-16 h-16 bg-surface-700/50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-inbox text-surface-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">
                    @if($rolNormalizado === 'supervisor')
                        No hay incidencias en el sistema
                    @elseif($rolNormalizado === 'usuario')
                        No has reportado incidencias
                    @else
                        No tienes incidencias asignadas
                    @endif
                </h3>
                <p class="text-surface-400 mb-4">
                    @if($rolNormalizado === 'supervisor')
                        Cuando se creen incidencias, aparecerán aquí.
                    @elseif($rolNormalizado === 'usuario')
                        <a href="{{ route('incidencias.create') }}" class="text-blue-400 hover:text-blue-300">
                            Reporta tu primera incidencia
                        </a>
                    @else
                        Cuando te asignen incidencias, aparecerán aquí.
                    @endif
                </p>
            </div>
        @endif
    </div>

    <!-- Scripts de Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: { color: '#b0b0b0' }
                }
            }
        };

        // Estado
        @if(isset($datosGraficos['estado']))
        new Chart(document.getElementById('estadoChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($datosGraficos['estado']['labels']) !!},
                datasets: [{
                    data: {!! json_encode($datosGraficos['estado']['data']) !!},
                    backgroundColor: ['#f59e0b', '#3b82f6', '#10b981', '#8b5cf6'],
                    borderColor: 'rgba(26, 26, 46, 1)',
                    borderWidth: 2
                }]
            },
            options: chartOptions
        });
        @endif

        // Prioridad
        @if(isset($datosGraficos['prioridad']))
        new Chart(document.getElementById('prioridadChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($datosGraficos['prioridad']['labels']) !!},
                datasets: [{
                    data: {!! json_encode($datosGraficos['prioridad']['data']) !!},
                    backgroundColor: ['#ef4444', '#f59e0b', '#10b981'],
                    borderColor: 'rgba(26, 26, 46, 1)',
                    borderWidth: 2
                }]
            },
            options: chartOptions
        });
        @endif

        // Tendencia
        @if(isset($datosGraficos['tendencia']))
        new Chart(document.getElementById('tendenciaChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($datosGraficos['tendencia']['labels']) !!},
                datasets: [{
                    label: 'Incidencias',
                    data: {!! json_encode($datosGraficos['tendencia']['data']) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: chartOptions
        });
        @endif

        // Categorías
        @if(isset($datosGraficos['categorias']))
        new Chart(document.getElementById('categoriasChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($datosGraficos['categorias']['labels']) !!},
                datasets: [{
                    label: 'Cantidad',
                    data: {!! json_encode($datosGraficos['categorias']['data']) !!},
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'],
                    borderRadius: 8
                }]
            },
            options: chartOptions
        });
        @endif

        // Técnicos
        @if(isset($datosGraficos['tecnicos']))
        new Chart(document.getElementById('tecnicosChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($datosGraficos['tecnicos']['labels']) !!},
                datasets: [{
                    label: 'Resueltas',
                    data: {!! json_encode($datosGraficos['tecnicos']['resueltas']) !!},
                    backgroundColor: '#10b981'
                }, {
                    label: 'En Proceso',
                    data: {!! json_encode($datosGraficos['tecnicos']['enProceso']) !!},
                    backgroundColor: '#3b82f6'
                }]
            },
            options: { ...chartOptions, indexAxis: 'y' }
        });
        @endif

        // Solicitudes
        @if(isset($datosGraficos['solicitudes']))
        new Chart(document.getElementById('solicitudesChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($datosGraficos['solicitudes']['labels']) !!},
                datasets: [{
                    data: {!! json_encode($datosGraficos['solicitudes']['data']) !!},
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderColor: 'rgba(26, 26, 46, 1)',
                    borderWidth: 2
                }]
            },
            options: chartOptions
        });
        @endif
    </script>
@endsection
