<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Incidex</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        },
                        surface: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .neon-glow {
            box-shadow: 0 0 10px rgba(74, 222, 128, 0.3),
            0 0 20px rgba(74, 222, 128, 0.2);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.3);
            border-color: #22c55e;
        }

        .sidebar-item.active {
            background: rgba(34, 197, 94, 0.1);
            border-left: 4px solid #22c55e;
            color: #22c55e;
        }

        .sidebar-item.active i {
            color: #22c55e;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .report-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .report-card:hover {
            transform: translateY(-2px);
            border-color: rgba(34, 197, 94, 0.3);
        }

        .metric-trend {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .trend-positive {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .trend-negative {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .trend-neutral {
            background-color: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .filter-tag {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.5rem;
            font-size: 0.875rem;
            color: #e2e8f0;
        }
    </style>
</head>
<body class="min-h-screen">
<!-- Layout Principal -->
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-surface-900 border-r border-surface-700 flex flex-col">
        <!-- Logo -->
        <div class="p-6 border-b border-surface-700">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center neon-glow">
                    <i class="fas fa-shield-alt text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Incidex</h1>
                    <p class="text-xs text-surface-400">Sistema v2.1</p>
                </div>
            </div>
        </div>

        <!-- Menú de Navegación -->
        <nav class="flex-1 p-4 space-y-2">
            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                    <i class="fas fa-plus-circle w-5 text-center"></i>
                    <span>Registrar Incidencia</span>
                </a>
            </div>

            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                    <i class="fas fa-tasks w-5 text-center"></i>
                    <span>Mis Incidencias</span>
                </a>
            </div>

            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                    <i class="fas fa-list w-5 text-center"></i>
                    <span>Todas las Incidencias</span>
                </a>
            </div>

            <!-- Separador -->
            <div class="border-t border-surface-700 my-4"></div>

            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                    <i class="fas fa-users w-5 text-center"></i>
                    <span>Usuarios</span>
                </a>
            </div>

            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                    <i class="fas fa-user-tag w-5 text-center"></i>
                    <span>Roles</span>
                </a>
            </div>

            <div class="sidebar-item active px-4 py-3 rounded-lg transition duration-200">
                <a href="#" class="flex items-center space-x-3 text-white">
                    <i class="fas fa-chart-bar w-5 text-center"></i>
                    <span>Reportes</span>
                </a>
            </div>
        </nav>

        <!-- Footer Sidebar -->
        <div class="p-4 border-t border-surface-700">
            <div class="flex items-center space-x-3 p-3 bg-surface-800/50 rounded-lg">
                <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">JM</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm text-white font-medium">Juan Martínez</p>
                    <p class="text-xs text-surface-400">Administrador</p>
                </div>
                <button class="text-surface-400 hover:text-white transition duration-200">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-surface-800 border-b border-surface-700 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white">Reportes y Estadísticas</h2>
                    <p class="text-surface-400 text-sm">Análisis detallado del sistema de incidencias</p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-surface-400 hover:text-white transition duration-200">
                        <i class="fas fa-bell"></i>
                    </button>
                    <div class="w-8 h-8 bg-surface-700 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-surface-300"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Filtros -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-white mb-2">Filtros de Reporte</h3>
                            <p class="text-surface-400 text-sm">Selecciona el período y parámetros para generar reportes</p>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button class="px-4 py-2 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center space-x-2">
                                <i class="fas fa-download"></i>
                                <span>Exportar PDF</span>
                            </button>
                            <button class="px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 neon-glow flex items-center space-x-2">
                                <i class="fas fa-sync-alt"></i>
                                <span>Actualizar</span>
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-surface-200 mb-2">Período</label>
                            <select class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                                <option value="7d">Últimos 7 días</option>
                                <option value="30d" selected>Últimos 30 días</option>
                                <option value="90d">Últimos 90 días</option>
                                <option value="1y">Último año</option>
                                <option value="custom">Personalizado</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-surface-200 mb-2">Desde</label>
                            <input type="date" class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200" value="2023-04-01">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-surface-200 mb-2">Hasta</label>
                            <input type="date" class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200" value="2023-04-30">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-surface-200 mb-2">Departamento</label>
                            <select class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                                <option value="">Todos los departamentos</option>
                                <option value="ti">TI</option>
                                <option value="ventas">Ventas</option>
                                <option value="marketing">Marketing</option>
                                <option value="rrhh">Recursos Humanos</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="filter-tag">
                            <span class="mr-2">Período: Últimos 30 días</span>
                            <button class="text-surface-400 hover:text-white">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </span>
                        <span class="filter-tag">
                            <span class="mr-2">Estado: Todos</span>
                            <button class="text-surface-400 hover:text-white">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </span>
                        <span class="filter-tag">
                            <span class="mr-2">Prioridad: Todas</span>
                            <button class="text-surface-400 hover:text-white">
                                <i class="fas fa-times text-xs"></i>
                            </button>
                        </span>
                    </div>
                </div>

                <!-- Métricas Principales -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="glass-effect report-card rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Total Incidencias</p>
                                <p class="text-3xl font-bold text-white mt-1">142</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-list text-blue-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="metric-trend trend-positive">
                                <i class="fas fa-arrow-up mr-1"></i> 12%
                            </span>
                            <span class="text-surface-400 text-sm ml-2">vs período anterior</span>
                        </div>
                    </div>

                    <div class="glass-effect report-card rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Tiempo Promedio Resolución</p>
                                <p class="text-3xl font-bold text-white mt-1">2.4</p>
                                <p class="text-surface-400 text-sm">días</p>
                            </div>
                            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-clock text-green-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="metric-trend trend-positive">
                                <i class="fas fa-arrow-down mr-1"></i> 15%
                            </span>
                            <span class="text-surface-400 text-sm ml-2">vs período anterior</span>
                        </div>
                    </div>

                    <div class="glass-effect report-card rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Satisfacción del Cliente</p>
                                <p class="text-3xl font-bold text-white mt-1">4.7</p>
                                <p class="text-surface-400 text-sm">/ 5.0</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-star text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="metric-trend trend-positive">
                                <i class="fas fa-arrow-up mr-1"></i> 8%
                            </span>
                            <span class="text-surface-400 text-sm ml-2">vs período anterior</span>
                        </div>
                    </div>

                    <div class="glass-effect report-card rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Incidencias Críticas</p>
                                <p class="text-3xl font-bold text-white mt-1">8</p>
                            </div>
                            <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center">
                            <span class="metric-trend trend-negative">
                                <i class="fas fa-arrow-up mr-1"></i> 5%
                            </span>
                            <span class="text-surface-400 text-sm ml-2">vs período anterior</span>
                        </div>
                    </div>
                </div>

                <!-- Gráficos Principales -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Tendencia de Incidencias -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Tendencia de Incidencias</h3>
                            <div class="flex space-x-2">
                                <button class="text-surface-400 hover:text-white transition duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="tendenciaChart"></canvas>
                        </div>
                    </div>

                    <!-- Distribución por Categoría -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Distribución por Categoría</h3>
                            <div class="flex space-x-2">
                                <button class="text-surface-400 hover:text-white transition duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="categoriaChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Gráficos Secundarios -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    <!-- Distribución por Prioridad -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Por Prioridad</h3>
                            <div class="flex space-x-2">
                                <button class="text-surface-400 hover:text-white transition duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="prioridadChart"></canvas>
                        </div>
                    </div>

                    <!-- Tiempo de Resolución -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Tiempo de Resolución</h3>
                            <div class="flex space-x-2">
                                <button class="text-surface-400 hover:text-white transition duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="resolucionChart"></canvas>
                        </div>
                    </div>

                    <!-- Distribución por Departamento -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Por Departamento</h3>
                            <div class="flex space-x-2">
                                <button class="text-surface-400 hover:text-white transition duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="departamentoChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Tablas de Datos -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Técnicos con Mejor Rendimiento -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Técnicos con Mejor Rendimiento</h3>
                            <button class="text-surface-400 hover:text-white transition duration-200">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-surface-800/50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">CR</span>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium text-sm">Carlos Rodríguez</p>
                                        <p class="text-surface-400 text-xs">32 incidencias resueltas</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-bold">4.8</p>
                                    <p class="text-surface-400 text-xs">calificación</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-surface-800/50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">AM</span>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium text-sm">Ana Mendoza</p>
                                        <p class="text-surface-400 text-xs">28 incidencias resueltas</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-bold">4.7</p>
                                    <p class="text-surface-400 text-xs">calificación</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-surface-800/50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">LG</span>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium text-sm">Luis González</p>
                                        <p class="text-surface-400 text-xs">25 incidencias resueltas</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-bold">4.6</p>
                                    <p class="text-surface-400 text-xs">calificación</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Incidencias Más Comunes -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Incidencias Más Comunes</h3>
                            <button class="text-surface-400 hover:text-white transition duration-200">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-surface-800/50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-red-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-network-wired text-red-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium text-sm">Problema de conexión a red</p>
                                        <p class="text-surface-400 text-xs">Categoría: Red</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-bold">18</p>
                                    <p class="text-surface-400 text-xs">ocurrencias</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-surface-800/50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-desktop text-blue-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium text-sm">Pantalla no enciende</p>
                                        <p class="text-surface-400 text-xs">Categoría: Hardware</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-bold">12</p>
                                    <p class="text-surface-400 text-xs">ocurrencias</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-surface-800/50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-software text-yellow-400"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium text-sm">Error en software contable</p>
                                        <p class="text-surface-400 text-xs">Categoría: Software</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-white font-bold">9</p>
                                    <p class="text-surface-400 text-xs">ocurrencias</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reporte Detallado -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-white">Reporte Detallado de Incidencias</h3>
                        <button class="px-4 py-2 bg-surface-800 text-surface-300 font-medium rounded-xl hover:bg-surface-700 transition duration-200 flex items-center space-x-2">
                            <i class="fas fa-file-export"></i>
                            <span>Exportar CSV</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-left text-surface-400 text-sm border-b border-surface-700">
                                <th class="pb-4 font-medium">ID</th>
                                <th class="pb-4 font-medium">Título</th>
                                <th class="pb-4 font-medium">Categoría</th>
                                <th class="pb-4 font-medium">Prioridad</th>
                                <th class="pb-4 font-medium">Estado</th>
                                <th class="pb-4 font-medium">Tiempo Resolución</th>
                                <th class="pb-4 font-medium">Satisfacción</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-700">
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2456</td>
                                <td class="py-4 text-white font-medium">Error en servidor de base de datos</td>
                                <td class="py-4 text-surface-300">Software</td>
                                <td class="py-4">
                                    <span class="px-2 py-1 bg-red-500/20 text-red-400 rounded text-xs">Crítica</span>
                                </td>
                                <td class="py-4">
                                    <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded text-xs">Resuelto</span>
                                </td>
                                <td class="py-4 text-surface-300">1.2 días</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <span class="text-white ml-1">4.5</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2455</td>
                                <td class="py-4 text-white font-medium">Pantalla no enciende</td>
                                <td class="py-4 text-surface-300">Hardware</td>
                                <td class="py-4">
                                    <span class="px-2 py-1 bg-orange-500/20 text-orange-400 rounded text-xs">Alta</span>
                                </td>
                                <td class="py-4">
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded text-xs">Cerrado</span>
                                </td>
                                <td class="py-4 text-surface-300">3.1 días</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <span class="text-white ml-1">4.8</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2454</td>
                                <td class="py-4 text-white font-medium">Problema de conexión a red</td>
                                <td class="py-4 text-surface-300">Red</td>
                                <td class="py-4">
                                    <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 rounded text-xs">Media</span>
                                </td>
                                <td class="py-4">
                                    <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded text-xs">Cerrado</span>
                                </td>
                                <td class="py-4 text-surface-300">0.8 días</td>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                                        <span class="text-white ml-1">5.0</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between mt-6 pt-6 border-t border-surface-700">
                        <div class="text-surface-400 text-sm">
                            Mostrando 3 de 142 incidencias
                        </div>
                        <button class="px-4 py-2 bg-surface-800 text-surface-300 font-medium rounded-xl hover:bg-surface-700 transition duration-200">
                            Ver Reporte Completo
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Inicializar gráficos cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de Tendencia
        const tendenciaCtx = document.getElementById('tendenciaChart').getContext('2d');
        const tendenciaChart = new Chart(tendenciaCtx, {
            type: 'line',
            data: {
                labels: ['1 Abr', '5 Abr', '10 Abr', '15 Abr', '20 Abr', '25 Abr', '30 Abr'],
                datasets: [{
                    label: 'Incidencias Reportadas',
                    data: [12, 19, 15, 25, 22, 18, 14],
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Incidencias Resueltas',
                    data: [8, 12, 10, 18, 20, 16, 15],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#e2e8f0'
                        }
                    }
                }
            }
        });

        // Gráfico de Categorías
        const categoriaCtx = document.getElementById('categoriaChart').getContext('2d');
        const categoriaChart = new Chart(categoriaCtx, {
            type: 'doughnut',
            data: {
                labels: ['Software', 'Hardware', 'Red', 'Seguridad', 'Usuario'],
                datasets: [{
                    data: [35, 25, 20, 12, 8],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#e2e8f0',
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Gráfico de Prioridades
        const prioridadCtx = document.getElementById('prioridadChart').getContext('2d');
        const prioridadChart = new Chart(prioridadCtx, {
            type: 'bar',
            data: {
                labels: ['Crítica', 'Alta', 'Media', 'Baja'],
                datasets: [{
                    label: 'Incidencias',
                    data: [8, 25, 65, 44],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(34, 197, 94, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Gráfico de Tiempo de Resolución
        const resolucionCtx = document.getElementById('resolucionChart').getContext('2d');
        const resolucionChart = new Chart(resolucionCtx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Días promedio',
                    data: [3.2, 2.9, 2.7, 2.4, 2.3, 2.1],
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#94a3b8'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#e2e8f0'
                        }
                    }
                }
            }
        });

        // Gráfico de Departamentos
        const departamentoCtx = document.getElementById('departamentoChart').getContext('2d');
        const departamentoChart = new Chart(departamentoCtx, {
            type: 'polarArea',
            data: {
                labels: ['TI', 'Ventas', 'Marketing', 'RRHH', 'Finanzas'],
                datasets: [{
                    data: [45, 28, 15, 8, 4],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#e2e8f0',
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    });

    // Marcar elemento activo en sidebar
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.sidebar-item').forEach(i => {
                i.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Efecto hover en tarjetas de métricas
    document.querySelectorAll('.report-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 0 20px rgba(74, 222, 128, 0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.boxShadow = 'none';
        });
    });
</script>
</body>
</html>
