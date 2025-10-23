<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles - Incidex</title>
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

        .permission-category {
            border-left: 3px solid;
            padding-left: 12px;
            margin-bottom: 16px;
        }

        .permission-category.incidencias {
            border-color: #4ade80;
        }

        .permission-category.usuarios {
            border-color: #60a5fa;
        }

        .permission-category.sistema {
            border-color: #f87171;
        }

        .permission-category.reportes {
            border-color: #fbbf24;
        }

        .role-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-admin {
            background-color: rgba(239, 68, 68, 0.2);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .role-supervisor {
            background-color: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .role-tecnico {
            background-color: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .role-usuario {
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

            <div class="sidebar-item active px-4 py-3 rounded-lg transition duration-200">
                <a href="#" class="flex items-center space-x-3 text-white">
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
                    <h2 class="text-xl font-bold text-white">Gestión de Roles</h2>
                    <p class="text-surface-400 text-sm">Administra los roles y permisos del sistema</p>
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
                <!-- Estadísticas Rápidas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Total Roles</p>
                                <p class="text-white text-2xl font-bold">4</p>
                            </div>
                            <div class="w-10 h-10 bg-primary-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-tag text-primary-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Usuarios Activos</p>
                                <p class="text-white text-2xl font-bold">42</p>
                            </div>
                            <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-check text-green-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Permisos Configurados</p>
                                <p class="text-white text-2xl font-bold">28</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-key text-blue-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Roles por Defecto</p>
                                <p class="text-white text-2xl font-bold">3</p>
                            </div>
                            <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-cog text-purple-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Listado de Roles y Gestión -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Panel de Roles -->
                    <div class="lg:col-span-1">
                        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-white">Roles del Sistema</h3>
                                <button id="btnNuevoRol" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition duration-200 flex items-center space-x-2">
                                    <i class="fas fa-plus"></i>
                                    <span>Nuevo Rol</span>
                                </button>
                            </div>

                            <!-- Lista de Roles -->
                            <div class="space-y-3">
                                <!-- Rol Administrador -->
                                <div class="role-item bg-surface-800/50 p-4 rounded-xl border border-surface-700 cursor-pointer transition duration-200 hover:border-primary-500 active-role" data-role="admin">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-white">Administrador</h4>
                                            <p class="text-surface-400 text-sm">Acceso completo al sistema</p>
                                        </div>
                                        <span class="role-badge role-admin">Admin</span>
                                    </div>
                                    <div class="mt-2 text-xs text-surface-500">
                                        <i class="fas fa-users mr-1"></i> 3 usuarios asignados
                                    </div>
                                </div>

                                <!-- Rol Supervisor -->
                                <div class="role-item bg-surface-800/50 p-4 rounded-xl border border-surface-700 cursor-pointer transition duration-200 hover:border-primary-500" data-role="supervisor">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-white">Supervisor</h4>
                                            <p class="text-surface-400 text-sm">Gestiona equipos y reportes</p>
                                        </div>
                                        <span class="role-badge role-supervisor">Supervisor</span>
                                    </div>
                                    <div class="mt-2 text-xs text-surface-500">
                                        <i class="fas fa-users mr-1"></i> 8 usuarios asignados
                                    </div>
                                </div>

                                <!-- Rol Técnico -->
                                <div class="role-item bg-surface-800/50 p-4 rounded-xl border border-surface-700 cursor-pointer transition duration-200 hover:border-primary-500" data-role="tecnico">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-white">Técnico</h4>
                                            <p class="text-surface-400 text-sm">Resuelve incidencias asignadas</p>
                                        </div>
                                        <span class="role-badge role-tecnico">Técnico</span>
                                    </div>
                                    <div class="mt-2 text-xs text-surface-500">
                                        <i class="fas fa-users mr-1"></i> 15 usuarios asignados
                                    </div>
                                </div>

                                <!-- Rol Usuario -->
                                <div class="role-item bg-surface-800/50 p-4 rounded-xl border border-surface-700 cursor-pointer transition duration-200 hover:border-primary-500" data-role="usuario">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-white">Usuario</h4>
                                            <p class="text-surface-400 text-sm">Acceso básico al sistema</p>
                                        </div>
                                        <span class="role-badge role-usuario">Usuario</span>
                                    </div>
                                    <div class="mt-2 text-xs text-surface-500">
                                        <i class="fas fa-users mr-1"></i> 16 usuarios asignados
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel de Detalles y Permisos -->
                    <div class="lg:col-span-2">
                        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                            <!-- Header del Rol Seleccionado -->
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 id="roleTitle" class="text-lg font-bold text-white">Administrador</h3>
                                    <p id="roleDescription" class="text-surface-400">Acceso completo al sistema</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button id="btnEditarRol" class="px-4 py-2 bg-surface-700 text-surface-300 rounded-lg hover:bg-surface-600 transition duration-200 flex items-center space-x-2">
                                        <i class="fas fa-edit"></i>
                                        <span>Editar</span>
                                    </button>
                                    <button id="btnEliminarRol" class="px-4 py-2 bg-red-500/20 text-red-400 rounded-lg hover:bg-red-500/30 transition duration-200 flex items-center space-x-2">
                                        <i class="fas fa-trash"></i>
                                        <span>Eliminar</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Información del Rol -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-surface-200 mb-2">Nombre del Rol</label>
                                    <input type="text" id="roleName" value="Administrador"
                                           class="input-focus bg-surface-800 text-white w-full px-4 py-2 border border-surface-600 rounded-lg focus:outline-none transition duration-200" disabled>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-surface-200 mb-2">Usuarios Asignados</label>
                                    <div class="flex items-center bg-surface-800 border border-surface-600 rounded-lg px-4 py-2">
                                        <span class="text-white">3 usuarios</span>
                                        <button class="ml-auto text-primary-400 hover:text-primary-300">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Permisos del Rol -->
                            <div>
                                <h4 class="text-md font-bold text-white mb-4">Permisos del Rol</h4>

                                <!-- Categoría: Incidencias -->
                                <div class="permission-category incidencias mb-4">
                                    <h5 class="font-semibold text-white mb-3">
                                        <i class="fas fa-tasks mr-2 text-primary-400"></i>Gestión de Incidencias
                                    </h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso1" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso1" class="ml-2 text-sm text-surface-300">Crear incidencias</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso2" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso2" class="ml-2 text-sm text-surface-300">Ver todas las incidencias</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso3" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso3" class="ml-2 text-sm text-surface-300">Editar incidencias</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso4" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso4" class="ml-2 text-sm text-surface-300">Eliminar incidencias</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso5" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso5" class="ml-2 text-sm text-surface-300">Asignar incidencias</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso6" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso6" class="ml-2 text-sm text-surface-300">Cambiar estado de incidencias</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categoría: Usuarios -->
                                <div class="permission-category usuarios mb-4">
                                    <h5 class="font-semibold text-white mb-3">
                                        <i class="fas fa-users mr-2 text-blue-400"></i>Gestión de Usuarios
                                    </h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso7" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso7" class="ml-2 text-sm text-surface-300">Ver usuarios</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso8" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso8" class="ml-2 text-sm text-surface-300">Crear usuarios</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso9" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso9" class="ml-2 text-sm text-surface-300">Editar usuarios</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso10" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso10" class="ml-2 text-sm text-surface-300">Eliminar usuarios</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso11" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso11" class="ml-2 text-sm text-surface-300">Asignar roles</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categoría: Sistema -->
                                <div class="permission-category sistema mb-4">
                                    <h5 class="font-semibold text-white mb-3">
                                        <i class="fas fa-cog mr-2 text-red-400"></i>Configuración del Sistema
                                    </h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso12" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso12" class="ml-2 text-sm text-surface-300">Gestionar roles</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso13" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso13" class="ml-2 text-sm text-surface-300">Configurar sistema</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso14" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso14" class="ml-2 text-sm text-surface-300">Ver logs del sistema</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Categoría: Reportes -->
                                <div class="permission-category reportes">
                                    <h5 class="font-semibold text-white mb-3">
                                        <i class="fas fa-chart-bar mr-2 text-yellow-400"></i>Reportes y Estadísticas
                                    </h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso15" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso15" class="ml-2 text-sm text-surface-300">Ver reportes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso16" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso16" class="ml-2 text-sm text-surface-300">Generar reportes</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="checkbox" id="permiso17" class="h-4 w-4 text-primary-500 border-surface-600 rounded bg-surface-800 focus:ring-primary-500" checked disabled>
                                            <label for="permiso17" class="ml-2 text-sm text-surface-300">Exportar reportes</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-surface-700">
                                <button class="px-4 py-2 border border-surface-600 text-surface-300 font-medium rounded-lg hover:bg-surface-800 transition duration-200">
                                    Cancelar
                                </button>
                                <button class="px-4 py-2 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition duration-200">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal para Nuevo Rol -->
<div id="modalNuevoRol" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
    <div class="glass-effect rounded-2xl p-6 border border-surface-700 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-white">Crear Nuevo Rol</h3>
            <button id="cerrarModal" class="text-surface-400 hover:text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-surface-200 mb-2">Nombre del Rol</label>
                <input type="text" class="input-focus bg-surface-800 text-white w-full px-4 py-2 border border-surface-600 rounded-lg focus:outline-none transition duration-200" placeholder="Ej: Auditor">
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-200 mb-2">Descripción</label>
                <textarea class="input-focus bg-surface-800 text-white w-full px-4 py-2 border border-surface-600 rounded-lg focus:outline-none transition duration-200" rows="3" placeholder="Describe las funciones de este rol..."></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" id="cancelarModal" class="px-4 py-2 border border-surface-600 text-surface-300 font-medium rounded-lg hover:bg-surface-800 transition duration-200">
                    Cancelar
                </button>
                <button type="submit" class="px-4 py-2 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition duration-200">
                    Crear Rol
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Datos de roles
    const rolesData = {
        admin: {
            title: "Administrador",
            description: "Acceso completo al sistema",
            users: 3,
            permissions: {
                incidencias: [true, true, true, true, true, true],
                usuarios: [true, true, true, true, true],
                sistema: [true, true, true],
                reportes: [true, true, true]
            }
        },
        supervisor: {
            title: "Supervisor",
            description: "Gestiona equipos y reportes",
            users: 8,
            permissions: {
                incidencias: [true, true, true, false, true, true],
                usuarios: [true, false, false, false, false],
                sistema: [false, false, false],
                reportes: [true, true, true]
            }
        },
        tecnico: {
            title: "Técnico",
            description: "Resuelve incidencias asignadas",
            users: 15,
            permissions: {
                incidencias: [true, false, true, false, false, true],
                usuarios: [false, false, false, false, false],
                sistema: [false, false, false],
                reportes: [false, false, false]
            }
        },
        usuario: {
            title: "Usuario",
            description: "Acceso básico al sistema",
            users: 16,
            permissions: {
                incidencias: [true, false, false, false, false, false],
                usuarios: [false, false, false, false, false],
                sistema: [false, false, false],
                reportes: [false, false, false]
            }
        }
    };

    // Marcar elemento activo en sidebar
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.addEventListener('click', function() {
            document.querySelectorAll('.sidebar-item').forEach(i => {
                i.classList.remove('active');
            });
            this.classList.add('active');
        });
    });

    // Selección de roles
    document.querySelectorAll('.role-item').forEach(item => {
        item.addEventListener('click', function() {
            // Remover clase activa de todos los roles
            document.querySelectorAll('.role-item').forEach(role => {
                role.classList.remove('active-role');
                role.classList.remove('border-primary-500');
            });

            // Agregar clase activa al rol seleccionado
            this.classList.add('active-role');
            this.classList.add('border-primary-500');

            // Obtener el tipo de rol
            const roleType = this.getAttribute('data-role');
            const roleData = rolesData[roleType];

            // Actualizar la información del rol
            document.getElementById('roleTitle').textContent = roleData.title;
            document.getElementById('roleDescription').textContent = roleData.description;
            document.getElementById('roleName').value = roleData.title;

            // Actualizar permisos
            updatePermissions(roleData.permissions);
        });
    });

    // Función para actualizar los permisos
    function updatePermissions(permissions) {
        // Incidencias
        permissions.incidencias.forEach((value, index) => {
            document.getElementById(`permiso${index+1}`).checked = value;
        });

        // Usuarios
        permissions.usuarios.forEach((value, index) => {
            document.getElementById(`permiso${index+7}`).checked = value;
        });

        // Sistema
        permissions.sistema.forEach((value, index) => {
            document.getElementById(`permiso${index+12}`).checked = value;
        });

        // Reportes
        permissions.reportes.forEach((value, index) => {
            document.getElementById(`permiso${index+15}`).checked = value;
        });
    }

    // Modal para nuevo rol
    document.getElementById('btnNuevoRol').addEventListener('click', function() {
        document.getElementById('modalNuevoRol').classList.remove('hidden');
    });

    document.getElementById('cerrarModal').addEventListener('click', function() {
        document.getElementById('modalNuevoRol').classList.add('hidden');
    });

    document.getElementById('cancelarModal').addEventListener('click', function() {
        document.getElementById('modalNuevoRol').classList.add('hidden');
    });

    // Botón eliminar rol
    document.getElementById('btnEliminarRol').addEventListener('click', function() {
        if (confirm('¿Estás seguro de que deseas eliminar este rol? Esta acción no se puede deshacer.')) {
            alert('Rol eliminado correctamente');
        }
    });
</script>
</body>
</html>
