<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Incidencias - Incidex</title>
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

        .priority-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .priority-critica {
            background-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .priority-alta {
            background-color: rgba(249, 115, 22, 0.2);
            color: #fb923c;
            border: 1px solid rgba(249, 115, 22, 0.3);
        }

        .priority-media {
            background-color: rgba(234, 179, 8, 0.2);
            color: #facc15;
            border: 1px solid rgba(234, 179, 8, 0.3);
        }

        .priority-baja {
            background-color: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pendiente {
            background-color: rgba(251, 191, 36, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.3);
        }

        .status-en-progreso {
            background-color: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .status-resuelta {
            background-color: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .status-cerrada {
            background-color: rgba(107, 114, 128, 0.2);
            color: #9ca3af;
            border: 1px solid rgba(107, 114, 128, 0.3);
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

            <div class="sidebar-item active px-4 py-3 rounded-lg transition duration-200">
                <a href="#" class="flex items-center space-x-3 text-white">
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
                    <h2 class="text-xl font-bold text-white">Listado de Incidencias</h2>
                    <p class="text-surface-400 text-sm">Gestiona y revisa todas las incidencias del sistema</p>
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
                <!-- Filtros y Búsqueda -->
                <div class="glass-effect rounded-xl p-4 mb-6 border border-surface-700">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-3 text-surface-400"></i>
                                <input type="text" placeholder="Buscar incidencias..."
                                       class="input-focus bg-surface-800 text-white w-full pl-10 pr-4 py-2 border border-surface-600 rounded-lg placeholder-surface-500 focus:outline-none transition duration-200">
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <select class="input-focus bg-surface-800 text-white px-4 py-2 border border-surface-600 rounded-lg focus:outline-none transition duration-200">
                                <option value="">Todas las categorías</option>
                                <option value="hardware">Hardware</option>
                                <option value="software">Software</option>
                                <option value="red">Red</option>
                                <option value="seguridad">Seguridad</option>
                                <option value="usuario">Problema de Usuario</option>
                            </select>
                            <select class="input-focus bg-surface-800 text-white px-4 py-2 border border-surface-600 rounded-lg focus:outline-none transition duration-200">
                                <option value="">Todos los estados</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="en-progreso">En Progreso</option>
                                <option value="resuelta">Resuelta</option>
                                <option value="cerrada">Cerrada</option>
                            </select>
                            <button class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition duration-200">
                                <i class="fas fa-filter mr-2"></i>Filtrar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas Rápidas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Total Incidencias</p>
                                <p class="text-white text-2xl font-bold">24</p>
                            </div>
                            <div class="w-10 h-10 bg-primary-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-list text-primary-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Pendientes</p>
                                <p class="text-white text-2xl font-bold">8</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">En Progreso</p>
                                <p class="text-white text-2xl font-bold">12</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-cog text-blue-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Resueltas</p>
                                <p class="text-white text-2xl font-bold">4</p>
                            </div>
                            <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Listado de Incidencias -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-white">Todas las Incidencias</h3>
                        <button class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition duration-200 flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Nueva Incidencia</span>
                        </button>
                    </div>

                    <!-- Tabla de Incidencias -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-surface-400">
                            <thead class="text-xs uppercase bg-surface-800/50 text-surface-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Título</th>
                                <th scope="col" class="px-6 py-3">Categoría</th>
                                <th scope="col" class="px-6 py-3">Prioridad</th>
                                <th scope="col" class="px-6 py-3">Estado</th>
                                <th scope="col" class="px-6 py-3">Asignado a</th>
                                <th scope="col" class="px-6 py-3">Fecha</th>
                                <th scope="col" class="px-6 py-3 text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- Incidencia 1 -->
                            <tr class="border-b border-surface-700 hover:bg-surface-800/30 transition duration-200">
                                <td class="px-6 py-4 font-medium text-white">INC-001</td>
                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">Error en servidor de base de datos</div>
                                    <div class="text-surface-400 text-xs truncate max-w-xs">El servidor principal de BD presenta caídas intermitentes durante las horas pico</div>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900/20 text-blue-400">
                                            <i class="fas fa-server mr-1"></i> Red
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="priority-badge priority-critica">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Crítica
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="status-badge status-en-progreso">
                                            <i class="fas fa-cog mr-1"></i> En Progreso
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center mr-2">
                                            <span class="text-white text-xs font-bold">AM</span>
                                        </div>
                                        <span class="text-surface-200">Ana Martínez</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">15/03/2023</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Incidencia 2 -->
                            <tr class="border-b border-surface-700 hover:bg-surface-800/30 transition duration-200">
                                <td class="px-6 py-4 font-medium text-white">INC-002</td>
                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">Problema con aplicación de facturación</div>
                                    <div class="text-surface-400 text-xs truncate max-w-xs">Los usuarios no pueden generar facturas desde el módulo de ventas</div>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-900/20 text-purple-400">
                                            <i class="fas fa-desktop mr-1"></i> Software
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="priority-badge priority-alta">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> Alta
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="status-badge status-pendiente">
                                            <i class="fas fa-clock mr-1"></i> Pendiente
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center mr-2">
                                            <span class="text-white text-xs font-bold">CP</span>
                                        </div>
                                        <span class="text-surface-200">Carlos Pérez</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">18/03/2023</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Incidencia 3 -->
                            <tr class="border-b border-surface-700 hover:bg-surface-800/30 transition duration-200">
                                <td class="px-6 py-4 font-medium text-white">INC-003</td>
                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">Impresora de contabilidad no funciona</div>
                                    <div class="text-surface-400 text-xs truncate max-w-xs">La impresora láser del área de contabilidad muestra error de papel atascado</div>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-900/20 text-orange-400">
                                            <i class="fas fa-print mr-1"></i> Hardware
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="priority-badge priority-media">
                                            <i class="fas fa-info-circle mr-1"></i> Media
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="status-badge status-resuelta">
                                            <i class="fas fa-check-circle mr-1"></i> Resuelta
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-2">
                                            <span class="text-white text-xs font-bold">LM</span>
                                        </div>
                                        <span class="text-surface-200">Laura Méndez</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">20/03/2023</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Incidencia 4 -->
                            <tr class="border-b border-surface-700 hover:bg-surface-800/30 transition duration-200">
                                <td class="px-6 py-4 font-medium text-white">INC-004</td>
                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">Actualización de seguridad requerida</div>
                                    <div class="text-surface-400 text-xs truncate max-w-xs">Se requiere aplicar parches de seguridad críticos en los servidores</div>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-900/20 text-red-400">
                                            <i class="fas fa-shield-alt mr-1"></i> Seguridad
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="priority-badge priority-critica">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Crítica
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="status-badge status-en-progreso">
                                            <i class="fas fa-cog mr-1"></i> En Progreso
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-primary-500 rounded-full flex items-center justify-center mr-2">
                                            <span class="text-white text-xs font-bold">AM</span>
                                        </div>
                                        <span class="text-surface-200">Ana Martínez</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">22/03/2023</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Incidencia 5 -->
                            <tr class="border-b border-surface-700 hover:bg-surface-800/30 transition duration-200">
                                <td class="px-6 py-4 font-medium text-white">INC-005</td>
                                <td class="px-6 py-4">
                                    <div class="text-white font-medium">Usuario no puede acceder al sistema</div>
                                    <div class="text-surface-400 text-xs truncate max-w-xs">El usuario María González reporta problemas de autenticación</div>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-900/20 text-gray-400">
                                            <i class="fas fa-user mr-1"></i> Usuario
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="priority-badge priority-baja">
                                            <i class="fas fa-info mr-1"></i> Baja
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                        <span class="status-badge status-cerrada">
                                            <i class="fas fa-times-circle mr-1"></i> Cerrada
                                        </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                                            <span class="text-white text-xs font-bold">RG</span>
                                        </div>
                                        <span class="text-surface-200">Roberto García</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">25/03/2023</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="flex items-center justify-between pt-6 border-t border-surface-700 mt-6">
                        <div class="text-surface-400 text-sm">
                            Mostrando <span class="font-medium text-white">1-5</span> de <span class="font-medium text-white">24</span> incidencias
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-3 py-1 bg-primary-500 text-white rounded-lg">1</button>
                            <button class="px-3 py-1 bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">2</button>
                            <button class="px-3 py-1 bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">3</button>
                            <button class="px-3 py-1 bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">4</button>
                            <button class="px-3 py-1 bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">5</button>
                            <button class="px-3 py-1 bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
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
