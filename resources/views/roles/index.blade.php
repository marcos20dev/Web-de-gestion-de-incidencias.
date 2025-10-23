@extends('layouts.dashboard')

@section('title', 'Gestión de Roles - Incidex')
@section('page-title', 'Gestión de Roles')
@section('page-description', 'Administra los roles del sistema')

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
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Gestión de Roles</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Alertas -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-2xl text-green-400">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-2xl text-red-400">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Header con Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Roles -->
            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm font-medium">Total Roles</p>
                        <p class="text-2xl font-bold text-white mt-1">{{ $estadisticas['total'] }}</p>
                    </div>
                    <div class="p-3 bg-blue-500/20 rounded-xl">
                        <i class="fas fa-user-tag text-blue-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Roles Predeterminados -->
            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm font-medium">Predeterminados</p>
                        <p class="text-2xl font-bold text-white mt-1">3</p>
                    </div>
                    <div class="p-3 bg-green-500/20 rounded-xl">
                        <i class="fas fa-shield-alt text-green-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Roles Personalizados -->
            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm font-medium">Personalizados</p>
                        <p class="text-2xl font-bold text-white mt-1">{{ max(0, $estadisticas['total'] - 3) }}</p>
                    </div>
                    <div class="p-3 bg-purple-500/20 rounded-xl">
                        <i class="fas fa-cogs text-purple-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- En Uso -->
            <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-surface-400 text-sm font-medium">En Uso</p>
                        <p class="text-2xl font-bold text-white mt-1">{{ $estadisticas['total'] }}</p>
                    </div>
                    <div class="p-3 bg-orange-500/20 rounded-xl">
                        <i class="fas fa-users text-orange-400 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-6">
            <form method="GET" action="{{ route('gestion-roles.index') }}">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex flex-col sm:flex-row gap-4 flex-1">
                        <!-- Búsqueda -->
                        <div class="flex-1">
                            <div class="relative">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-surface-400"></i>
                                <input type="text"
                                       name="search"
                                       placeholder="Buscar roles..."
                                       value="{{ $search }}"
                                       class="w-full pl-10 pr-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200">
                            </div>
                        </div>

                        <!-- Filtro por Tipo -->
                        <select class="px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200">
                            <option value="">Todos los tipos</option>
                            <option value="predeterminado">Predeterminados</option>
                            <option value="personalizado">Personalizados</option>
                        </select>
                    </div>

                    <div class="flex space-x-3">
                        <!-- Botón Limpiar -->
                        <a href="{{ route('gestion-roles.index') }}"
                           class="px-4 py-3 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center space-x-2">
                            <i class="fas fa-times"></i>
                            <span>Limpiar</span>
                        </a>

                        <!-- Botón Nuevo Rol -->
                        <button type="button"
                                id="btn-nuevo-rol"
                                class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center space-x-2 whitespace-nowrap">
                            <i class="fas fa-plus-circle"></i>
                            <span>Nuevo Rol</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Contenido de la Tabla -->
        <div class="glass-effect rounded-2xl border border-surface-700 overflow-hidden">
            <!-- Header de la Tabla -->
            <div class="px-6 py-4 bg-surface-800/50 border-b border-surface-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">Lista de Roles</h3>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-surface-400 hover:text-white transition duration-200" title="Refrescar">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                    <tr class="text-left text-surface-400 text-sm border-b border-surface-700 bg-surface-800/50">
                        <th class="px-6 py-4 font-medium">ID</th>
                        <th class="px-6 py-4 font-medium">Nombre del Rol</th>
                        <th class="px-6 py-4 font-medium">Tipo</th>
                        <th class="px-6 py-4 font-medium">Usuarios Asignados</th>
                        <th class="px-6 py-4 font-medium">Fecha Creación</th>
                        <th class="px-6 py-4 font-medium text-right">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-700">
                    @forelse($roles as $rol)
                        <tr class="text-sm hover:bg-surface-800/30 transition duration-200">
                            <td class="px-6 py-4 text-surface-300 font-mono">
                                #{{ $rol->id_roles }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                                            {{ $rol->isSystemDefault() ? 'bg-blue-500/20' : 'bg-purple-500/20' }}">
                                        <i class="fas fa-user-tag {{ $rol->isSystemDefault() ? 'text-blue-400' : 'text-purple-400' }}"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-medium">{{ ucfirst($rol->nombre) }}</p>
                                        <p class="text-surface-400 text-xs">
                                            {{ $rol->isSystemDefault() ? 'Rol del sistema' : 'Rol personalizado' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $rol->isSystemDefault() ?
                                           'bg-blue-500/20 text-blue-400 border border-blue-500/30' :
                                           'bg-purple-500/20 text-purple-400 border border-purple-500/30' }}">
                                        @if($rol->isSystemDefault())
                                            <i class="fas fa-shield-alt mr-1"></i>
                                            Predeterminado
                                        @else
                                            <i class="fas fa-cog mr-1"></i>
                                            Personalizado
                                        @endif
                                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-white font-medium">0</span>
                                    <span class="text-surface-400 text-xs">usuarios</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-surface-300">
                                {{ $rol->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    <!-- Botón Editar -->
                                    @if(!$rol->isSystemDefault())
                                        <button onclick="abrirModalEditar({{ $rol->id_roles }}, '{{ $rol->nombre }}')"
                                                class="p-2 text-surface-400 hover:text-yellow-400 transition duration-200 rounded-lg hover:bg-yellow-400/10"
                                                title="Editar rol">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @else
                                        <button class="p-2 text-surface-600 cursor-not-allowed"
                                                title="No se puede editar (rol del sistema)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif

                                    <!-- Botón Permisos -->
                                    <button class="p-2 text-surface-400 hover:text-blue-400 transition duration-200 rounded-lg hover:bg-blue-400/10"
                                            title="Gestionar permisos">
                                        <i class="fas fa-key"></i>
                                    </button>

                                    <!-- Botón Eliminar -->
                                    @if(!$rol->isSystemDefault())
                                        <button onclick="confirmarEliminacion({{ $rol->id_roles }}, '{{ $rol->nombre }}')"
                                                class="p-2 text-surface-400 hover:text-red-400 transition duration-200 rounded-lg hover:bg-red-400/10"
                                                title="Eliminar rol">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @else
                                        <button class="p-2 text-surface-600 cursor-not-allowed"
                                                title="No se puede eliminar (rol del sistema)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12">
                                <div class="text-center">
                                    <div class="w-24 h-24 mx-auto mb-4 bg-surface-800/50 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-tag text-surface-400 text-3xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-white mb-2">No hay roles</h3>
                                    <p class="text-surface-400 mb-6">No se encontraron roles en el sistema.</p>
                                    <button id="btn-crear-primer-rol"
                                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center space-x-2 mx-auto">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Crear Primer Rol</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Rol -->
    <div id="modal-crear" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-white">Crear Nuevo Rol</h3>
                <button type="button" class="text-surface-400 hover:text-white cerrar-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('gestion-roles.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-white mb-2">Nombre del Rol *</label>
                        <input type="text" name="nombre"
                               class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                               placeholder="Ej: supervisor, auditor, etc."
                               required>
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button"
                                class="flex-1 px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200 cerrar-modal">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200">
                            Crear Rol
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para Editar Rol -->
    <div id="modal-editar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 max-w-md w-full mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-white">Editar Rol</h3>
                <button type="button" class="text-surface-400 hover:text-white cerrar-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="form-editar" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="nombre_edit" class="block text-sm font-medium text-white mb-2">Nombre del Rol *</label>
                        <input type="text" id="nombre_edit" name="nombre"
                               class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                               required>
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button"
                                class="flex-1 px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200 cerrar-modal">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-medium rounded-xl transition duration-200">
                            Actualizar Rol
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Confirmación para Eliminar -->
    <div id="modal-eliminar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">¿Eliminar Rol?</h3>
                <p class="text-surface-400 mb-4">Esta acción no se puede deshacer. El rol <span id="nombre-rol" class="font-medium text-white"></span> se eliminará permanentemente.</p>
                <p class="text-yellow-400 text-sm mb-6">Asegúrate de que ningún usuario tenga asignado este rol.</p>
                <div class="flex space-x-3">
                    <button type="button"
                            class="flex-1 px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200 cerrar-modal">
                        Cancelar
                    </button>
                    <form id="form-eliminar" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl transition duration-200">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Esperar a que el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM cargado - Inicializando modales...');

            // Botones para abrir modal crear
            document.getElementById('btn-nuevo-rol')?.addEventListener('click', abrirModalCrear);
            document.getElementById('btn-crear-primer-rol')?.addEventListener('click', abrirModalCrear);

            // Cerrar modales
            document.querySelectorAll('.cerrar-modal').forEach(button => {
                button.addEventListener('click', function() {
                    cerrarTodosLosModales();
                });
            });

            // Cerrar al hacer click fuera del modal
            document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        cerrarTodosLosModales();
                    }
                });
            });

            // Cerrar con ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    cerrarTodosLosModales();
                }
            });

            console.log('Modales inicializados correctamente');
        });

        function abrirModalCrear() {
            console.log('Abriendo modal crear...');
            document.getElementById('modal-crear').style.display = 'flex';
        }

        function abrirModalEditar(rolId, rolNombre) {
            console.log('Abriendo modal editar para:', rolNombre);
            document.getElementById('nombre_edit').value = rolNombre;
            document.getElementById('form-editar').action = `/gestion-roles/${rolId}`;
            document.getElementById('modal-editar').style.display = 'flex';
        }

        function confirmarEliminacion(rolId, rolNombre) {
            console.log('Confirmando eliminación para:', rolNombre);
            document.getElementById('nombre-rol').textContent = rolNombre;
            document.getElementById('form-eliminar').action = `/gestion-roles/${rolId}`;
            document.getElementById('modal-eliminar').style.display = 'flex';
        }

        function cerrarTodosLosModales() {
            console.log('Cerrando todos los modales...');
            document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                modal.style.display = 'none';
            });
        }
    </script>
@endsection
