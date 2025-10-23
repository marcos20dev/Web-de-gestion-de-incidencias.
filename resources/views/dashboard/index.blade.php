@extends('layouts.dashboard')

@section('title', 'Dashboard - Incidex')
@section('page-title', 'Dashboard')
@section('page-description', 'Resumen general del sistema de incidencias')

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
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Dashboard</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Tarjeta de Bienvenida Personalizada -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">
                        ¡Bienvenido, {{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}!
                    </h1>
                    <p class="text-surface-300">
                        Has iniciado sesión correctamente como
                        <span class="text-primary-400 font-medium capitalize">{{ Auth::user()->rol }}</span>
                        en el sistema Incidex.
                    </p>
                    <div class="flex items-center space-x-4 mt-4">
                        <div class="flex items-center space-x-2 text-surface-400">
                            <i class="fas fa-user-tag"></i>
                            <span class="text-sm capitalize">{{ Auth::user()->rol }}</span>
                        </div>
                        <div class="flex items-center space-x-2 text-surface-400">
                            <i class="fas fa-envelope"></i>
                            <span class="text-sm">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="flex items-center space-x-2 text-surface-400">
                            <i class="fas fa-calendar"></i>
                            <span class="text-sm">{{ Auth::user()->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center neon-glow">
                <span class="text-white text-2xl font-bold">
                    {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}{{ strtoupper(substr(Auth::user()->apellido_paterno, 0, 1)) }}
                </span>
                </div>
            </div>
        </div>

        <!-- Estadísticas Principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">Total Incidencias</p>
                        <p class="text-3xl font-bold text-white mt-1">142</p>
                    </div>
                    <div class="w-12 h-12 bg-primary-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-list text-primary-400 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                <span class="text-green-500 text-sm flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> 12%
                </span>
                    <span class="text-surface-400 text-sm ml-2">vs mes anterior</span>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">Pendientes</p>
                        <p class="text-3xl font-bold text-white mt-1">24</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-400 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                <span class="text-red-500 text-sm flex items-center">
                    <i class="fas fa-arrow-down mr-1"></i> 5%
                </span>
                    <span class="text-surface-400 text-sm ml-2">vs mes anterior</span>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">En Proceso</p>
                        <p class="text-3xl font-bold text-white mt-1">18</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-cog text-blue-400 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                <span class="text-green-500 text-sm flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> 8%
                </span>
                    <span class="text-surface-400 text-sm ml-2">vs mes anterior</span>
                </div>
            </div>

            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm">Resueltas</p>
                        <p class="text-3xl font-bold text-white mt-1">100</p>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                <span class="text-green-500 text-sm flex items-center">
                    <i class="fas fa-arrow-up mr-1"></i> 15%
                </span>
                    <span class="text-surface-400 text-sm ml-2">vs mes anterior</span>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas según Rol -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-8">
            <h3 class="text-lg font-bold text-white mb-4">Acciones Rápidas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @if(Auth::user()->rol === 'admin')
                    <button class="glass-effect p-4 rounded-xl border border-surface-700 hover:border-primary-500 transition duration-200 text-left">
                        <i class="fas fa-users text-primary-400 text-xl mb-2"></i>
                        <h4 class="font-semibold text-white">Gestionar Usuarios</h4>
                        <p class="text-surface-400 text-sm mt-1">Administrar usuarios del sistema</p>
                    </button>
                    <button class="glass-effect p-4 rounded-xl border border-surface-700 hover:border-primary-500 transition duration-200 text-left">
                        <i class="fas fa-cog text-primary-400 text-xl mb-2"></i>
                        <h4 class="font-semibold text-white">Configuración</h4>
                        <p class="text-surface-400 text-sm mt-1">Configurar sistema</p>
                    </button>
                @endif

                @if(in_array(Auth::user()->rol, ['admin', 'tecnico']))
                    <button class="glass-effect p-4 rounded-xl border border-surface-700 hover:border-primary-500 transition duration-200 text-left">
                        <i class="fas fa-tools text-primary-400 text-xl mb-2"></i>
                        <h4 class="font-semibold text-white">Incidencias</h4>
                        <p class="text-surface-400 text-sm mt-1">Gestionar incidencias</p>
                    </button>
                @endif

                <button class="glass-effect p-4 rounded-xl border border-surface-700 hover:border-primary-500 transition duration-200 text-left">
                    <i class="fas fa-plus-circle text-primary-400 text-xl mb-2"></i>
                    <h4 class="font-semibold text-white">Nueva Incidencia</h4>
                    <p class="text-surface-400 text-sm mt-1">Reportar problema</p>
                </button>

                <button class="glass-effect p-4 rounded-xl border border-surface-700 hover:border-primary-500 transition duration-200 text-left">
                    <i class="fas fa-chart-bar text-primary-400 text-xl mb-2"></i>
                    <h4 class="font-semibold text-white">Reportes</h4>
                    <p class="text-surface-400 text-sm mt-1">Ver estadísticas</p>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Scripts específicos del dashboard
        console.log('Dashboard cargado para: {{ Auth::user()->nombre }}');
    </script>
@endsection
