<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Incidex</title>
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

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-activo {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-inactivo {
            background-color: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .status-pendiente {
            background-color: rgba(251, 191, 36, 0.1);
            color: #f59e0b;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .role-admin {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .role-tecnico {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .role-usuario {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .role-soporte {
            background-color: rgba(168, 85, 247, 0.1);
            color: #a855f7;
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

            <div class="sidebar-item active px-4 py-3 rounded-lg transition duration-200">
                <a href="#" class="flex items-center space-x-3 text-white">
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
                    <h2 class="text-xl font-bold text-white">Gestión de Usuarios</h2>
                    <p class="text-surface-400 text-sm">Administra los usuarios del sistema</p>
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
                <!-- Barra de Herramientas -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
                    <div class="flex-1">
                        <div class="relative max-w-md">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-surface-400"></i>
                            <input type="text" placeholder="Buscar usuarios..."
                                   class="input-focus bg-surface-800 text-white w-full pl-10 pr-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200">
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center space-x-2">
                            <i class="fas fa-filter"></i>
                            <span>Filtrar</span>
                        </button>
                        <button id="btnNuevoUsuario" class="px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 neon-glow flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Nuevo Usuario</span>
                        </button>
                    </div>
                </div>

                <!-- Estadísticas Rápidas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Total Usuarios</p>
                                <p class="text-2xl font-bold text-white mt-1">48</p>
                            </div>
                            <div class="w-10 h-10 bg-primary-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-primary-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Activos</p>
                                <p class="text-2xl font-bold text-white mt-1">42</p>
                            </div>
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-check text-green-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Técnicos</p>
                                <p class="text-2xl font-bold text-white mt-1">12</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tools text-blue-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Administradores</p>
                                <p class="text-2xl font-bold text-white mt-1">4</p>
                            </div>
                            <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-shield text-red-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Usuarios -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-left text-surface-400 text-sm border-b border-surface-700">
                                <th class="pb-4 font-medium">Usuario</th>
                                <th class="pb-4 font-medium">Rol</th>
                                <th class="pb-4 font-medium">Departamento</th>
                                <th class="pb-4 font-medium">Email</th>
                                <th class="pb-4 font-medium">Teléfono</th>
                                <th class="pb-4 font-medium">Estado</th>
                                <th class="pb-4 font-medium">Último Acceso</th>
                                <th class="pb-4 font-medium text-right">Acciones</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-700">
                            <tr class="text-sm">
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">JM</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Juan Martínez</p>
                                            <p class="text-surface-400 text-xs">@jmartinez</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="role-badge role-admin">Administrador</span>
                                </td>
                                <td class="py-4 text-surface-300">TI</td>
                                <td class="py-4 text-surface-300">juan.martinez@empresa.com</td>
                                <td class="py-4 text-surface-300">+1 234 567 890</td>
                                <td class="py-4">
                                    <span class="status-badge status-activo">Activo</span>
                                </td>
                                <td class="py-4 text-surface-300">Hoy, 09:24</td>
                                <td class="py-4">
                                    <div class="flex justify-end space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200 p-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">CR</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Carlos Rodríguez</p>
                                            <p class="text-surface-400 text-xs">@crodriguez</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="role-badge role-tecnico">Técnico</span>
                                </td>
                                <td class="py-4 text-surface-300">Soporte TI</td>
                                <td class="py-4 text-surface-300">carlos.rodriguez@empresa.com</td>
                                <td class="py-4 text-surface-300">+1 234 567 891</td>
                                <td class="py-4">
                                    <span class="status-badge status-activo">Activo</span>
                                </td>
                                <td class="py-4 text-surface-300">Ayer, 16:45</td>
                                <td class="py-4">
                                    <div class="flex justify-end space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200 p-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">AM</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Ana Mendoza</p>
                                            <p class="text-surface-400 text-xs">@amendoza</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="role-badge role-tecnico">Técnico</span>
                                </td>
                                <td class="py-4 text-surface-300">Soporte TI</td>
                                <td class="py-4 text-surface-300">ana.mendoza@empresa.com</td>
                                <td class="py-4 text-surface-300">+1 234 567 892</td>
                                <td class="py-4">
                                    <span class="status-badge status-activo">Activo</span>
                                </td>
                                <td class="py-4 text-surface-300">Ayer, 14:20</td>
                                <td class="py-4">
                                    <div class="flex justify-end space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200 p-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">LG</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Laura González</p>
                                            <p class="text-surface-400 text-xs">@lgonzalez</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="role-badge role-usuario">Usuario</span>
                                </td>
                                <td class="py-4 text-surface-300">Ventas</td>
                                <td class="py-4 text-surface-300">laura.gonzalez@empresa.com</td>
                                <td class="py-4 text-surface-300">+1 234 567 893</td>
                                <td class="py-4">
                                    <span class="status-badge status-activo">Activo</span>
                                </td>
                                <td class="py-4 text-surface-300">Hoy, 08:15</td>
                                <td class="py-4">
                                    <div class="flex justify-end space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200 p-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs font-bold">MJ</span>
                                        </div>
                                        <div>
                                            <p class="text-white font-medium">Miguel Jiménez</p>
                                            <p class="text-surface-400 text-xs">@mjimenez</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <span class="role-badge role-soporte">Soporte</span>
                                </td>
                                <td class="py-4 text-surface-300">Atención al Cliente</td>
                                <td class="py-4 text-surface-300">miguel.jimenez@empresa.com</td>
                                <td class="py-4 text-surface-300">+1 234 567 894</td>
                                <td class="py-4">
                                    <span class="status-badge status-inactivo">Inactivo</span>
                                </td>
                                <td class="py-4 text-surface-300">15/05/2023</td>
                                <td class="py-4">
                                    <div class="flex justify-end space-x-2">
                                        <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-surface-400 hover:text-red-400 transition duration-200 p-1">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="flex items-center justify-between mt-6 pt-6 border-t border-surface-700">
                        <div class="text-surface-400 text-sm">
                            Mostrando 1-5 de 48 usuarios
                        </div>
                        <div class="flex space-x-2">
                            <button class="w-8 h-8 flex items-center justify-center bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center bg-primary-500 text-white rounded-lg">1</button>
                            <button class="w-8 h-8 flex items-center justify-center bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">2</button>
                            <button class="w-8 h-8 flex items-center justify-center bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">3</button>
                            <button class="w-8 h-8 flex items-center justify-center bg-surface-800 text-surface-400 rounded-lg hover:bg-surface-700 transition duration-200">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Nuevo Usuario -->
<div id="modalNuevoUsuario" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="glass-effect rounded-2xl p-6 border border-surface-700 w-full max-w-md">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-white">Nuevo Usuario</h3>
            <button id="cerrarModal" class="text-surface-400 hover:text-white transition duration-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-surface-200 mb-2">Nombre Completo</label>
                <input type="text" class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200" placeholder="Ingresa el nombre completo">
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-200 mb-2">Email</label>
                <input type="email" class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200" placeholder="usuario@empresa.com">
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-200 mb-2">Rol</label>
                <select class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                    <option value="">Selecciona un rol</option>
                    <option value="admin">Administrador</option>
                    <option value="tecnico">Técnico</option>
                    <option value="usuario">Usuario</option>
                    <option value="soporte">Soporte</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-200 mb-2">Departamento</label>
                <select class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                    <option value="">Selecciona departamento</option>
                    <option value="ti">TI</option>
                    <option value="ventas">Ventas</option>
                    <option value="marketing">Marketing</option>
                    <option value="rrhh">Recursos Humanos</option>
                </select>
            </div>

            <div class="flex space-x-3 pt-4">
                <button type="button" id="cancelarUsuario" class="flex-1 py-3 px-4 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 neon-glow">
                    Crear Usuario
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Manejo del modal de nuevo usuario
    document.getElementById('btnNuevoUsuario').addEventListener('click', function() {
        document.getElementById('modalNuevoUsuario').classList.remove('hidden');
    });

    document.getElementById('cerrarModal').addEventListener('click', function() {
        document.getElementById('modalNuevoUsuario').classList.add('hidden');
    });

    document.getElementById('cancelarUsuario').addEventListener('click', function() {
        document.getElementById('modalNuevoUsuario').classList.add('hidden');
    });

    // Cerrar modal al hacer clic fuera
    document.getElementById('modalNuevoUsuario').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
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
