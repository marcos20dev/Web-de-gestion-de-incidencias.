<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles - Incidex</title>
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

        .role-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .role-card:hover {
            transform: translateY(-2px);
            border-color: rgba(34, 197, 94, 0.3);
        }

        .permission-group {
            border-left: 3px solid;
            padding-left: 1rem;
        }

        .permission-admin {
            border-color: #ef4444;
        }

        .permission-tecnico {
            border-color: #3b82f6;
        }

        .permission-usuario {
            border-color: #22c55e;
        }

        .permission-soporte {
            border-color: #a855f7;
        }

        .user-count {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 500;
        }

        .user-count-admin {
            background-color: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .user-count-tecnico {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .user-count-usuario {
            background-color: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .user-count-soporte {
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
                <!-- Barra de Herramientas -->
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-white mb-2">Roles del Sistema</h3>
                        <p class="text-surface-400 text-sm">Gestiona los permisos y accesos de cada rol</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center space-x-2">
                            <i class="fas fa-download"></i>
                            <span>Exportar</span>
                        </button>
                        <button id="btnNuevoRol" class="px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 neon-glow flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Nuevo Rol</span>
                        </button>
                    </div>
                </div>

                <!-- Estadísticas Rápidas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="glass-effect rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-surface-400 text-sm">Total Roles</p>
                                <p class="text-2xl font-bold text-white mt-1">6</p>
                            </div>
                            <div class="w-10 h-10 bg-primary-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-tag text-primary-400"></i>
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
                                <p class="text-surface-400 text-sm">Usuarios</p>
                                <p class="text-2xl font-bold text-white mt-1">32</p>
                            </div>
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-green-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid de Roles -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Rol Administrador -->
                    <div class="glass-effect role-card rounded-2xl p-6 border border-red-500/20">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-crown text-red-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">Administrador</h3>
                                    <span class="user-count user-count-admin">4 usuarios</span>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <p class="text-surface-300 text-sm mb-4">
                            Acceso completo al sistema. Puede gestionar usuarios, roles, incidencias y configuraciones.
                        </p>

                        <div class="permission-group permission-admin mb-4">
                            <h4 class="text-surface-200 font-medium text-sm mb-2">Permisos Principales</h4>
                            <ul class="text-surface-400 text-sm space-y-1">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-400 mr-2 text-xs"></i>
                                    Gestión completa de usuarios
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-400 mr-2 text-xs"></i>
                                    Administración de roles
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-400 mr-2 text-xs"></i>
                                    Acceso a todos los reportes
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-red-400 mr-2 text-xs"></i>
                                    Configuración del sistema
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-surface-700">
                            <span class="text-surface-400 text-xs">Creado: 15/01/2023</span>
                            <button class="px-3 py-1 bg-red-500/20 text-red-400 text-xs font-medium rounded-lg hover:bg-red-500/30 transition duration-200">
                                Gestionar
                            </button>
                        </div>
                    </div>

                    <!-- Rol Técnico -->
                    <div class="glass-effect role-card rounded-2xl p-6 border border-blue-500/20">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-tools text-blue-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">Técnico</h3>
                                    <span class="user-count user-count-tecnico">12 usuarios</span>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <p class="text-surface-300 text-sm mb-4">
                            Gestiona y resuelve incidencias. Puede asignar técnicos y actualizar estados.
                        </p>

                        <div class="permission-group permission-tecnico mb-4">
                            <h4 class="text-surface-200 font-medium text-sm mb-2">Permisos Principales</h4>
                            <ul class="text-surface-400 text-sm space-y-1">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-blue-400 mr-2 text-xs"></i>
                                    Gestionar incidencias asignadas
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-blue-400 mr-2 text-xs"></i>
                                    Actualizar estados de incidencias
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-blue-400 mr-2 text-xs"></i>
                                    Acceso a reportes técnicos
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-blue-400 mr-2 text-xs"></i>
                                    Comunicación con usuarios
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-surface-700">
                            <span class="text-surface-400 text-xs">Creado: 20/01/2023</span>
                            <button class="px-3 py-1 bg-blue-500/20 text-blue-400 text-xs font-medium rounded-lg hover:bg-blue-500/30 transition duration-200">
                                Gestionar
                            </button>
                        </div>
                    </div>

                    <!-- Rol Usuario -->
                    <div class="glass-effect role-card rounded-2xl p-6 border border-green-500/20">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-user text-green-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">Usuario</h3>
                                    <span class="user-count user-count-usuario">32 usuarios</span>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <p class="text-surface-300 text-sm mb-4">
                            Puede reportar incidencias y ver el estado de sus tickets. Acceso básico al sistema.
                        </p>

                        <div class="permission-group permission-usuario mb-4">
                            <h4 class="text-surface-200 font-medium text-sm mb-2">Permisos Principales</h4>
                            <ul class="text-surface-400 text-sm space-y-1">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                                    Registrar nuevas incidencias
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                                    Ver sus incidencias
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                                    Comentar en sus tickets
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                                    Cerrar incidencias resueltas
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-surface-700">
                            <span class="text-surface-400 text-xs">Creado: 22/01/2023</span>
                            <button class="px-3 py-1 bg-green-500/20 text-green-400 text-xs font-medium rounded-lg hover:bg-green-500/30 transition duration-200">
                                Gestionar
                            </button>
                        </div>
                    </div>

                    <!-- Rol Soporte -->
                    <div class="glass-effect role-card rounded-2xl p-6 border border-purple-500/20">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-headset text-purple-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">Soporte</h3>
                                    <span class="user-count user-count-soporte">8 usuarios</span>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <p class="text-surface-300 text-sm mb-4">
                            Atención al cliente y soporte básico. Puede ver todas las incidencias pero no resolverlas.
                        </p>

                        <div class="permission-group permission-soporte mb-4">
                            <h4 class="text-surface-200 font-medium text-sm mb-2">Permisos Principales</h4>
                            <ul class="text-surface-400 text-sm space-y-1">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-purple-400 mr-2 text-xs"></i>
                                    Ver todas las incidencias
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-purple-400 mr-2 text-xs"></i>
                                    Comunicación con usuarios
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-purple-400 mr-2 text-xs"></i>
                                    Asignar prioridades
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-purple-400 mr-2 text-xs"></i>
                                    Reportes básicos
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-surface-700">
                            <span class="text-surface-400 text-xs">Creado: 25/01/2023</span>
                            <button class="px-3 py-1 bg-purple-500/20 text-purple-400 text-xs font-medium rounded-lg hover:bg-purple-500/30 transition duration-200">
                                Gestionar
                            </button>
                        </div>
                    </div>

                    <!-- Rol Auditor -->
                    <div class="glass-effect role-card rounded-2xl p-6 border border-yellow-500/20">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-yellow-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-chart-bar text-yellow-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">Auditor</h3>
                                    <span class="user-count user-count-tecnico">2 usuarios</span>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <p class="text-surface-300 text-sm mb-4">
                            Acceso de solo lectura a reportes y estadísticas. No puede modificar datos.
                        </p>

                        <div class="permission-group permission-tecnico mb-4">
                            <h4 class="text-surface-200 font-medium text-sm mb-2">Permisos Principales</h4>
                            <ul class="text-surface-400 text-sm space-y-1">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-yellow-400 mr-2 text-xs"></i>
                                    Acceso a todos los reportes
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-yellow-400 mr-2 text-xs"></i>
                                    Ver estadísticas del sistema
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-yellow-400 mr-2 text-xs"></i>
                                    Exportar datos
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-yellow-400 mr-2 text-xs"></i>
                                    Ver logs del sistema
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-surface-700">
                            <span class="text-surface-400 text-xs">Creado: 30/01/2023</span>
                            <button class="px-3 py-1 bg-yellow-500/20 text-yellow-400 text-xs font-medium rounded-lg hover:bg-yellow-500/30 transition duration-200">
                                Gestionar
                            </button>
                        </div>
                    </div>

                    <!-- Rol Supervisor -->
                    <div class="glass-effect role-card rounded-2xl p-6 border border-indigo-500/20">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-indigo-500/20 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-eye text-indigo-400 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white">Supervisor</h3>
                                    <span class="user-count user-count-soporte">3 usuarios</span>
                                </div>
                            </div>
                            <div class="flex space-x-1">
                                <button class="text-surface-400 hover:text-primary-400 transition duration-200 p-1">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-surface-400 hover:text-blue-400 transition duration-200 p-1">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>

                        <p class="text-surface-300 text-sm mb-4">
                            Supervisa el trabajo del equipo técnico. Puede ver y asignar incidencias.
                        </p>

                        <div class="permission-group permission-soporte mb-4">
                            <h4 class="text-surface-200 font-medium text-sm mb-2">Permisos Principales</h4>
                            <ul class="text-surface-400 text-sm space-y-1">
                                <li class="flex items-center">
                                    <i class="fas fa-check text-indigo-400 mr-2 text-xs"></i>
                                    Ver todas las incidencias
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-indigo-400 mr-2 text-xs"></i>
                                    Asignar técnicos
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-indigo-400 mr-2 text-xs"></i>
                                    Reportes de equipo
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-check text-indigo-400 mr-2 text-xs"></i>
                                    Gestión de prioridades
                                </li>
                            </ul>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-surface-700">
                            <span class="text-surface-400 text-xs">Creado: 05/02/2023</span>
                            <button class="px-3 py-1 bg-indigo-500/20 text-indigo-400 text-xs font-medium rounded-lg hover:bg-indigo-500/30 transition duration-200">
                                Gestionar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Permisos Detallados -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-bold text-white">Matriz de Permisos</h3>
                        <button class="text-surface-400 hover:text-white transition duration-200">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-left text-surface-400 text-sm border-b border-surface-700">
                                <th class="pb-4 font-medium">Módulo</th>
                                <th class="pb-4 font-medium text-center">Administrador</th>
                                <th class="pb-4 font-medium text-center">Técnico</th>
                                <th class="pb-4 font-medium text-center">Usuario</th>
                                <th class="pb-4 font-medium text-center">Soporte</th>
                                <th class="pb-4 font-medium text-center">Auditor</th>
                                <th class="pb-4 font-medium text-center">Supervisor</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-700">
                            <tr class="text-sm">
                                <td class="py-4 text-white font-medium">Dashboard</td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-white font-medium">Registrar Incidencia</td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-white font-medium">Gestionar Incidencias</td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-eye text-blue-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-eye text-blue-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-white font-medium">Gestión de Usuarios</td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-white font-medium">Gestión de Roles</td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-white font-medium">Reportes Avanzados</td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                            </tr>
                            <tr class="text-sm">
                                <td class="py-4 text-white font-medium">Configuración Sistema</td>
                                <td class="py-4 text-center"><i class="fas fa-check text-green-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                                <td class="py-4 text-center"><i class="fas fa-times text-red-400"></i></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-between mt-6 pt-6 border-t border-surface-700">
                        <div class="text-surface-400 text-sm">
                            <i class="fas fa-info-circle text-primary-400 mr-2"></i>
                            Leyenda: <i class="fas fa-check text-green-400 mx-1"></i> Completo
                            <i class="fas fa-eye text-blue-400 mx-1"></i> Solo lectura
                            <i class="fas fa-times text-red-400 mx-1"></i> Sin acceso
                        </div>
                        <button class="px-4 py-2 bg-surface-800 text-surface-300 font-medium rounded-xl hover:bg-surface-700 transition duration-200">
                            Actualizar Permisos
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Nuevo Rol -->
<div id="modalNuevoRol" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="glass-effect rounded-2xl p-6 border border-surface-700 w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-white">Crear Nuevo Rol</h3>
            <button id="cerrarModalRol" class="text-surface-400 hover:text-white transition duration-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-surface-200 mb-2">Nombre del Rol</label>
                    <input type="text" class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200" placeholder="Ej: Coordinador">
                </div>

                <div>
                    <label class="block text-sm font-medium text-surface-200 mb-2">Color Identificador</label>
                    <select class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                        <option value="">Selecciona un color</option>
                        <option value="red">Rojo - Administrativo</option>
                        <option value="blue">Azul - Técnico</option>
                        <option value="green">Verde - Usuario</option>
                        <option value="purple">Púrpura - Soporte</option>
                        <option value="yellow">Amarillo - Auditoría</option>
                        <option value="indigo">Índigo - Supervisión</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-200 mb-2">Descripción</label>
                <textarea rows="3" class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200" placeholder="Describe las funciones y responsabilidades de este rol..."></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-surface-200 mb-4">Permisos del Rol</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Dashboard</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Registrar Incidencias</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Ver Todas las Incidencias</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Gestionar Incidencias</span>
                        </label>
                    </div>
                    <div class="space-y-3">
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Gestión de Usuarios</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Gestión de Roles</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Reportes Avanzados</span>
                        </label>
                        <label class="flex items-center space-x-3">
                            <input type="checkbox" class="rounded bg-surface-800 border-surface-600 text-primary-500 focus:ring-primary-500">
                            <span class="text-surface-200 text-sm">Configuración del Sistema</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3 pt-4">
                <button type="button" id="cancelarRol" class="flex-1 py-3 px-4 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 py-3 px-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 neon-glow">
                    Crear Rol
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Manejo del modal de nuevo rol
    document.getElementById('btnNuevoRol').addEventListener('click', function() {
        document.getElementById('modalNuevoRol').classList.remove('hidden');
    });

    document.getElementById('cerrarModalRol').addEventListener('click', function() {
        document.getElementById('modalNuevoRol').classList.add('hidden');
    });

    document.getElementById('cancelarRol').addEventListener('click', function() {
        document.getElementById('modalNuevoRol').classList.add('hidden');
    });

    // Cerrar modal al hacer clic fuera
    document.getElementById('modalNuevoRol').addEventListener('click', function(e) {
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

    // Efecto hover en tarjetas de roles
    document.querySelectorAll('.role-card').forEach(card => {
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
