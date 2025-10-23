<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Incidex</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pendiente {
            background-color: rgba(251, 191, 36, 0.1);
            color: #f59e0b;
        }

        .status-proceso {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .status-resuelto {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-cerrado {
            background-color: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .priority-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .priority-baja {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .priority-media {
            background-color: rgba(251, 191, 36, 0.1);
            color: #f59e0b;
        }

        .priority-alta {
            background-color: rgba(249, 115, 22, 0.1);
            color: #f97316;
        }

        .priority-critica {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
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
            <div class="sidebar-item active px-4 py-3 rounded-lg transition duration-200">
                <a href="#" class="flex items-center space-x-3 text-white">
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

            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
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
                    <h2 class="text-xl font-bold text-white">Dashboard</h2>
                    <p class="text-surface-400 text-sm">Resumen general del sistema de incidencias</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="text-surface-400 hover:text-white transition duration-200">
                            <i class="fas fa-bell"></i>
                        </button>
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
                    </div>
                    <div class="w-8 h-8 bg-surface-700 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-surface-300"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-7xl mx-auto">
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

                <!-- Gráficos y Tablas -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Gráfico de Incidencias por Estado -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Incidencia por Estado</h3>
                            <div class="flex space-x-2">
                                <button class="text-surface-400 hover:text-white transition duration-200">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="estadoChart"></canvas>
                        </div>
                    </div>

                    <!-- Gráfico de Incidencias por Categoría -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-white">Incidencia por Categoría</h3>
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

                <!-- Incidencias Recientes -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-white">Incidencias Recientes</h3>
                        <a href="#" class="text-primary-400 hover:text-primary-300 text-sm font-medium flex items-center">
                            Ver todas <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-left text-surface-400 text-sm border-b border-surface-700">
                                <th class="pb-3 font-medium">ID</th>
                                <th class="pb-3 font-medium">Título</th>
                                <th class="pb-3 font-medium">Categoría</th>
                                <th class="pb-3 font-medium">Prioridad</th>
                                <th class="pb-3 font-medium">Estado</th>
                                <th class="pb-3 font-medium">Fecha</th>
                                <th class="pb-3 font-medium">Asignado a</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-700">
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2456</td>
                                <td class="py-4 text-white font-medium">Error en servidor de base de datos</td>
                                <td class="py-4 text-surface-300">Software</td>
                                <td class="py-4">
                                    <span class="priority-badge priority-critica">Crítica</span>
                                </td>
                                <td class="py-4">
                                    <span class="status-badge status-proceso">En Proceso</span>
                                </td>
                                <td class="py-4 text-surface-300">15/05/2023</td>
                                <td class="py-4 text-surface-300">Carlos R.</td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2455</td>
                                <td class="py-4 text-white font-medium">Pantalla no enciende</td>
                                <td class="py-4 text-surface-300">Hardware</td>
                                <td class="py-4">
                                    <span class="priority-badge priority-alta">Alta</span>
                                </td>
                                <td class="py-4">
                                    <span class="status-badge status-pendiente">Pendiente</span>
                                </td>
                                <td class="py-4 text-surface-300">14/05/2023</td>
                                <td class="py-4 text-surface-300">-</td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2454</td>
                                <td class="py-4 text-white font-medium">Problema de conexión a red</td>
                                <td class="py-4 text-surface-300">Red</td>
                                <td class="py-4">
                                    <span class="priority-badge priority-media">Media</span>
                                </td>
                                <td class="py-4">
                                    <span class="status-badge status-resuelto">Resuelto</span>
                                </td>
                                <td class="py-4 text-surface-300">13/05/2023</td>
                                <td class="py-4 text-surface-300">Ana M.</td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2453</td>
                                <td class="py-4 text-white font-medium">Actualización de software requerida</td>
                                <td class="py-4 text-surface-300">Software</td>
                                <td class="py-4">
                                    <span class="priority-badge priority-baja">Baja</span>
                                </td>
                                <td class="py-4">
                                    <span class="status-badge status-cerrado">Cerrado</span>
                                </td>
                                <td class="py-4 text-surface-300">12/05/2023</td>
                                <td class="py-4 text-surface-300">Luis G.</td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-surface-300">#INC-2452</td>
                                <td class="py-4 text-white font-medium">Acceso denegado a sistema</td>
                                <td class="py-4 text-surface-300">Seguridad</td>
                                <td class="py-4">
                                    <span class="priority-badge priority-alta">Alta</span>
                                </td>
                                <td class="py-4">
                                    <span class="status-badge status-proceso">En Proceso</span>
                                </td>
                                <td class="py-4 text-surface-300">11/05/2023</td>
                                <td class="py-4 text-surface-300">María J.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Métricas de Rendimiento -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Tiempo Promedio de Resolución -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-white">Tiempo Promedio de Resolución</h3>
                            <i class="fas fa-clock text-primary-400"></i>
                        </div>
                        <div class="text-3xl font-bold text-white mb-2">2.4 <span class="text-lg text-surface-400">días</span></div>
                        <div class="text-surface-400 text-sm">Reducción del 15% vs mes anterior</div>
                    </div>

                    <!-- Incidencias por Usuario -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-white">Incidencias por Usuario</h3>
                            <i class="fas fa-users text-primary-400"></i>
                        </div>
                        <div class="text-3xl font-bold text-white mb-2">3.2 <span class="text-lg text-surface-400">por usuario</span></div>
                        <div class="text-surface-400 text-sm">Promedio mensual</div>
                    </div>

                    <!-- Satisfacción del Cliente -->
                    <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-white">Satisfacción del Cliente</h3>
                            <i class="fas fa-star text-primary-400"></i>
                        </div>
                        <div class="text-3xl font-bold text-white mb-2">4.7 <span class="text-lg text-surface-400">/ 5</span></div>
                        <div class="text-surface-400 text-sm">Basado en 85 evaluaciones</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Inicializar gráficos cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfico de Incidencias por Estado
        const estadoCtx = document.getElementById('estadoChart').getContext('2d');
        const estadoChart = new Chart(estadoCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pendientes', 'En Proceso', 'Resueltas', 'Cerradas'],
                datasets: [{
                    data: [24, 18, 85, 15],
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(107, 114, 128, 0.8)'
                    ],
                    borderColor: [
                        'rgba(251, 191, 36, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(34, 197, 94, 1)',
                        'rgba(107, 114, 128, 1)'
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

        // Gráfico de Incidencias por Categoría
        const categoriaCtx = document.getElementById('categoriaChart').getContext('2d');
        const categoriaChart = new Chart(categoriaCtx, {
            type: 'bar',
            data: {
                labels: ['Software', 'Hardware', 'Red', 'Seguridad', 'Usuario'],
                datasets: [{
                    label: 'Incidencias',
                    data: [65, 35, 22, 12, 8],
                    backgroundColor: 'rgba(34, 197, 94, 0.7)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 1
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
</script>
</body>
</html>
