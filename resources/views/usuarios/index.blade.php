@extends('layouts.dashboard')

@section('title', 'Gestión de Usuarios - Incidex')
@section('page-title', 'Gestión de Usuarios')
@section('page-description', 'Administra los usuarios del sistema')

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
                        <span class="ml-1 text-sm font-medium text-white md:ml-2">Gestión de Usuarios</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Alertas -->
    @if (session('success'))
    <div class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-2xl text-green-400">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-2xl text-red-400">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Header con Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Usuarios -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-surface-400 text-sm font-medium">Total Usuarios</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $totalUsuarios }}</p>
                </div>
                <div class="p-3 bg-blue-500/20 rounded-xl">
                    <i class="fas fa-users text-blue-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Usuarios Activos -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-surface-400 text-sm font-medium">Activos</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $usuariosActivos }}</p>
                </div>
                <div class="p-3 bg-green-500/20 rounded-xl">
                    <i class="fas fa-user-check text-green-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Pendientes -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-surface-400 text-sm font-medium">Pendientes</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $usuariosPendientes }}</p>
                </div>
                <div class="p-3 bg-yellow-500/20 rounded-xl">
                    <i class="fas fa-user-clock text-yellow-400 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Suspendidos -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-surface-400 text-sm font-medium">Suspendidos</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $usuariosSuspendidos }}</p>
                </div>
                <div class="p-3 bg-red-500/20 rounded-xl">
                    <i class="fas fa-user-slash text-red-400 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros y Búsqueda -->
    <div class="glass-effect rounded-2xl p-6 border border-surface-700 mb-6">
        <form method="GET" action="{{ route('gestion-usuarios.index') }}">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-4 flex-1">
                    <!-- Búsqueda -->
                    <div class="flex-1">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-surface-400"></i>
                            <input type="text" name="search" placeholder="Buscar usuarios..." value="{{ $search }}" class="w-full pl-10 pr-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200">
                        </div>
                    </div>

                    <!-- Filtro por Estado -->
                    <select name="estado" class="px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200">
                        <option value="todos" {{ $estado=='todos' ? 'selected' : '' }}>Todos los estados</option>
                        <option value="activo" {{ $estado=='activo' ? 'selected' : '' }}>Activo</option>
                        <option value="pendiente" {{ $estado=='pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="suspendido" {{ $estado=='suspendido' ? 'selected' : '' }}>Suspendido</option>
                    </select>

                    <!-- Filtro por Rol -->
                    <select name="rol" class="px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200">
                        <option value="todos" {{ $rol=='todos' ? 'selected' : '' }}>Todos los roles</option>
                        <option value="usuario" {{ $rol=='usuario' ? 'selected' : '' }}>Usuario</option>
                        <option value="tecnico" {{ $rol=='tecnico' ? 'selected' : '' }}>Técnico</option>
                        <option value="admin" {{ $rol=='admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>

                <div class="flex space-x-3">
                    <!-- Botón Limpiar -->
                    <a href="{{ route('gestion-usuarios.index') }}" class="px-4 py-3 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center space-x-2">
                        <i class="fas fa-times"></i>
                        <span>Limpiar</span>
                    </a>

                    <!-- Botón Nuevo Usuario -->
                    <button type="button" id="btn-nuevo-usuario" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center space-x-2 whitespace-nowrap">
                        <i class="fas fa-user-plus"></i>
                        <span>Nuevo Usuario</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabs por Rol -->
    <div class="mb-6">
        <div class="border-b border-surface-700">
            <nav class="-mb-px flex space-x-8 overflow-x-auto">
                <!-- Tab Todos -->
                <a href="{{ route('gestion-usuarios.index', ['tab' => 'todos'] + request()->except('tab')) }}" class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap {{ $tab == 'todos' ? 'border-primary-500 text-primary-400' : 'border-transparent text-surface-400 hover:text-surface-300' }}">
                    <i class="fas fa-list"></i>
                    <span>Todos</span>
                    <span class="bg-surface-700 text-surface-300 text-xs px-2 py-1 rounded-full">{{ $totalUsuarios }}</span>
                </a>

                <!-- Tab Usuarios -->
                <a href="{{ route('gestion-usuarios.index', ['tab' => 'usuarios'] + request()->except('tab')) }}" class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap {{ $tab == 'usuarios' ? 'border-primary-500 text-primary-400' : 'border-transparent text-surface-400 hover:text-surface-300' }}">
                    <i class="fas fa-user"></i>
                    <span>Usuarios</span>
                    <span class="bg-surface-700 text-surface-300 text-xs px-2 py-1 rounded-full">{{ $countUsuarios }}</span>
                </a>

                <!-- Tab Técnicos -->
                <a href="{{ route('gestion-usuarios.index', ['tab' => 'tecnicos'] + request()->except('tab')) }}" class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap {{ $tab == 'tecnicos' ? 'border-primary-500 text-primary-400' : 'border-transparent text-surface-400 hover:text-surface-300' }}">
                    <i class="fas fa-tools"></i>
                    <span>Técnicos</span>
                    <span class="bg-surface-700 text-surface-300 text-xs px-2 py-1 rounded-full">{{ $countTecnicos }}</span>
                </a>

                <!-- Tab Administradores -->
                <a href="{{ route('gestion-usuarios.index', ['tab' => 'supervisores'] + request()->except('tab')) }}" class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap {{ $tab == 'supervisores' ? 'border-primary-500 text-primary-400' : 'border-transparent text-surface-400 hover:text-surface-300' }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Administradores</span>
                    <span class="bg-surface-700 text-surface-300 text-xs px-2 py-1 rounded-full">{{ $countAdmins }}</span>
                </a>

                <!-- Tab Pendientes -->
                <a href="{{ route('gestion-usuarios.index', ['tab' => 'pendientes'] + request()->except('tab')) }}" class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap {{ $tab == 'pendientes' ? 'border-primary-500 text-primary-400' : 'border-transparent text-surface-400 hover:text-surface-300' }}">
                    <i class="fas fa-clock"></i>
                    <span>Pendientes</span>
                    <span class="bg-yellow-500/20 text-yellow-400 text-xs px-2 py-1 rounded-full">{{ $usuariosPendientes }}</span>
                </a>

                <!-- Tab Suspendidos -->
                <a href="{{ route('gestion-usuarios.index', ['tab' => 'suspendidos'] + request()->except('tab')) }}" class="py-4 px-1 border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap {{ $tab == 'suspendidos' ? 'border-primary-500 text-primary-400' : 'border-transparent text-surface-400 hover:text-surface-300' }}">
                    <i class="fas fa-user-slash"></i>
                    <span>Suspendidos</span>
                    <span class="bg-red-500/20 text-red-400 text-xs px-2 py-1 rounded-full">{{ $usuariosSuspendidos }}</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Contenido de la Tabla -->
    <div class="glass-effect rounded-2xl border border-surface-700 overflow-hidden">
        <!-- Header de la Tabla -->
        <div class="px-6 py-4 bg-surface-800/50 border-b border-surface-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">
                    @switch($tab)
                    @case('usuarios')
                    Usuarios del Sistema
                    @break

                    @case('tecnicos')
                    Técnicos
                    @break

                    @case('supervisores')
                    Administradores
                    @break

                    @case('pendientes')
                    Usuarios Pendientes
                    @break

                    @case('suspendidos')
                    Usuarios Suspendidos
                    @break

                    @default
                    Todos los Usuarios
                    @endswitch
                </h3>
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
                        <th class="px-6 py-4 font-medium">Usuario</th>
                        <th class="px-6 py-4 font-medium">Rol</th>
                        <th class="px-6 py-4 font-medium">Estado</th>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">Registro</th>
                        <th class="px-6 py-4 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-700">
                    @forelse($usuarios as $usuario)
                    <tr class="text-sm hover:bg-surface-800/30 transition duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-surface-700 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-surface-400"></i>
                                </div>
                                <div>
                                    <p class="text-white font-medium">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }}</p>
                                    <p class="text-surface-400 text-xs">{{ $usuario->apellido_materno }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $rolNombre = $usuario->rol->nombre ?? 'Usuario';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
        {{ strtolower($rolNombre) == 'admin'
            ? 'bg-red-500/20 text-red-400 border border-red-500/30'
            : (strtolower($rolNombre) == 'tecnico'
                ? 'bg-purple-500/20 text-purple-400 border border-purple-500/30'
                : 'bg-blue-500/20 text-blue-400 border border-blue-500/30') }}">
                                @if (strtolower($rolNombre) == 'admin')
                                <i class="fas fa-user-shield mr-1"></i>
                                @elseif(strtolower($rolNombre) == 'tecnico')
                                <i class="fas fa-tools mr-1"></i>
                                @else
                                <i class="fas fa-user mr-1"></i>
                                @endif
                                {{ $rolNombre }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <!-- Estado General -->
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $usuario->estado == 'activo'
                                                ? 'bg-green-500/20 text-green-400 border border-green-500/30'
                                                : ($usuario->estado == 'pendiente'
                                                    ? 'bg-yellow-500/20 text-yellow-400 border border-yellow-500/30'
                                                    : 'bg-red-500/20 text-red-400 border border-red-500/30') }}">
                                    @if ($usuario->estado == 'activo')
                                    <i class="fas fa-check-circle mr-1"></i>
                                    @elseif($usuario->estado == 'pendiente')
                                    <i class="fas fa-clock mr-1"></i>
                                    @else
                                    <i class="fas fa-ban mr-1"></i>
                                    @endif
                                    {{ ucfirst($usuario->estado) }}
                                </span>

                                <!-- Estado Técnico (solo para técnicos) -->
                                @if($usuario->rol_id == 2 && $usuario->estadoTecnico)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $usuario->estadoTecnico->estado == 'disponible'
                                                ? 'bg-green-500/20 text-green-400 border border-green-500/30'
                                                : ($usuario->estadoTecnico->estado == 'ocupado'
                                                    ? 'bg-orange-500/20 text-orange-400 border border-orange-500/30'
                                                    : 'bg-red-500/20 text-red-400 border border-red-500/30') }}">
                                    @if ($usuario->estadoTecnico->estado == 'disponible')
                                    <i class="fas fa-user-check mr-1"></i>
                                    @elseif($usuario->estadoTecnico->estado == 'ocupado')
                                    <i class="fas fa-user-clock mr-1"></i>
                                    @else
                                    <i class="fas fa-user-slash mr-1"></i>
                                    @endif
                                    {{ ucfirst($usuario->estadoTecnico->estado) }}
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-surface-300">
                            {{ $usuario->email }}
                        </td>
                        <td class="px-6 py-4 text-surface-300">
                            {{ $usuario->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end space-x-2">
                                <!-- Botones para Técnicos -->
                                @if($usuario->rol_id == 2)
                                    <!-- Botón Aprobar Técnico (solo si está pendiente) -->
                                    @if($usuario->estado == 'pendiente')
                                    <form method="POST" action="{{ route('gestion-usuarios.aprobar-tecnico', $usuario->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="p-2 text-surface-400 hover:text-green-400 transition duration-200 rounded-lg hover:bg-green-400/10" title="Aprobar técnico">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                    </form>
                                    @endif

                                    <!-- Botón Cambiar Estado Técnico -->
                                    <button onclick="mostrarModalEstadoTecnico({{ $usuario->id }}, '{{ $usuario->estadoTecnico->estado ?? 'disponible' }}', '{{ $usuario->estadoTecnico->observacion ?? '' }}')" class="p-2 text-surface-400 hover:text-blue-400 transition duration-200 rounded-lg hover:bg-blue-400/10" title="Cambiar estado técnico">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                @endif

                                <!-- Botón Estado General -->
                                @if ($usuario->estado == 'activo')
                                <button onclick="cambiarEstado({{ $usuario->id }}, 'suspendido')" class="p-2 text-surface-400 hover:text-red-400 transition duration-200 rounded-lg hover:bg-red-400/10" title="Suspender usuario">
                                    <i class="fas fa-ban"></i>
                                </button>
                                @elseif($usuario->estado == 'suspendido')
                                <button onclick="cambiarEstado({{ $usuario->id }}, 'activo')" class="p-2 text-surface-400 hover:text-green-400 transition duration-200 rounded-lg hover:bg-green-400/10" title="Activar usuario">
                                    <i class="fas fa-check"></i>
                                </button>
                                @else
                                <button onclick="cambiarEstado({{ $usuario->id }}, 'activo')" class="p-2 text-surface-400 hover:text-green-400 transition duration-200 rounded-lg hover:bg-green-400/10" title="Aprobar usuario">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                                @endif

                                <!-- Botón Eliminar -->
                                <button onclick="confirmarEliminacion({{ $usuario->id }}, '{{ $usuario->nombre }}')" class="p-2 text-surface-400 hover:text-red-400 transition duration-200 rounded-lg hover:bg-red-400/10" title="Eliminar usuario">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12">
                            <div class="text-center">
                                <div class="w-24 h-24 mx-auto mb-4 bg-surface-800/50 rounded-full flex items-center justify-center">
                                    <i class="fas fa-users text-surface-400 text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">No hay usuarios</h3>
                                <p class="text-surface-400 mb-6">No se encontraron usuarios con los filtros aplicados.</p>
                                <button id="btn-crear-primer-usuario" class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center space-x-2 mx-auto w-fit">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Crear Primer Usuario</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer de la Tabla -->
        @if ($usuarios->hasPages())
        <div class="px-6 py-4 bg-surface-800/50 border-t border-surface-700">
            <div class="flex items-center justify-between text-sm text-surface-400">
                <div>
                    Mostrando <span class="font-medium text-white">{{ $usuarios->firstItem() }}</span>
                    a <span class="font-medium text-white">{{ $usuarios->lastItem() }}</span> de
                    <span class="font-medium text-white">{{ $usuarios->total() }}</span> usuarios
                </div>
                <div class="flex items-center space-x-2">
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal para Crear Usuario -->
<div id="modal-crear" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
    <div class="glass-effect rounded-2xl p-6 border border-surface-700 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-white">Crear Nuevo Usuario</h3>
            <button type="button" class="text-surface-400 hover:text-white cerrar-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form method="POST" action="{{ route('gestion-usuarios.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nombre -->
                <div>
                    <label for="nombre" class="block text-sm font-medium text-white mb-2">Nombre *</label>
                    <input type="text" id="nombre" name="nombre" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" placeholder="Nombre del usuario" required>
                </div>

                <!-- Apellido Paterno -->
                <div>
                    <label for="apellido_paterno" class="block text-sm font-medium text-white mb-2">Apellido Paterno *</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" placeholder="Apellido paterno" required>
                </div>

                <!-- Apellido Materno -->
                <div>
                    <label for="apellido_materno" class="block text-sm font-medium text-white mb-2">Apellido Materno *</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" placeholder="Apellido materno" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-2">Email *</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" placeholder="usuario@ejemplo.com" required>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white mb-2">Contraseña *</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" placeholder="Mínimo 8 caracteres" required>
                </div>

                <!-- Confirmar Contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Confirmar Contraseña *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" placeholder="Repite la contraseña" required>
                </div>

                <!-- Rol -->
                <div>
                    <label for="rol" class="block text-sm font-medium text-white mb-2">Rol *</label>
                    <select id="rol" name="rol" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" required>
                        <option value="">Selecciona un rol</option>
                        <option value="usuario">Usuario</option>
                        <option value="tecnico">Técnico</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <!-- Estado -->
                <div>
                    <label for="estado" class="block text-sm font-medium text-white mb-2">Estado *</label>
                    <select id="estado" name="estado" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="activo">Activo</option>
                        <option value="suspendido">Suspendido</option>
                    </select>
                </div>
            </div>

            <div class="flex space-x-3 pt-6 mt-4 border-t border-surface-700">
                <button type="button" class="flex-1 px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200 cerrar-modal">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200">
                    Crear Usuario
                </button>
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
            <h3 class="text-lg font-bold text-white mb-2">¿Eliminar Usuario?</h3>
            <p class="text-surface-400 mb-4">Esta acción no se puede deshacer. El usuario <span id="nombre-usuario" class="font-medium text-white"></span> se eliminará permanentemente.</p>
            <p class="text-yellow-400 text-sm mb-6">Se verificará que no tenga incidencias asociadas.</p>
            <div class="flex space-x-3">
                <button type="button" class="flex-1 px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200 cerrar-modal">
                    Cancelar
                </button>
                <form id="form-eliminar" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-medium rounded-xl transition duration-200">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cambiar Estado de Técnico -->
<div id="modal-estado-tecnico" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
    <div class="glass-effect rounded-2xl p-6 border border-surface-700 max-w-md w-full mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-white">Cambiar Estado del Técnico</h3>
            <button type="button" class="text-surface-400 hover:text-white cerrar-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="form-estado-tecnico" method="POST">
            @csrf
            <div class="space-y-4">
                <!-- Estado -->
                <div>
                    <label for="estado_tecnico" class="block text-sm font-medium text-white mb-2">Estado *</label>
                    <select id="estado_tecnico" name="estado" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" required>
                        <option value="disponible">Disponible</option>
                        <option value="ocupado">Ocupado</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

                <!-- Observación -->
                <div>
                    <label for="observacion" class="block text-sm font-medium text-white mb-2">Observación</label>
                    <textarea id="observacion" name="observacion" rows="3" class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200" placeholder="Observación opcional..."></textarea>
                </div>
            </div>

            <div class="flex space-x-3 pt-6 mt-4 border-t border-surface-700">
                <button type="button" class="flex-1 px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200 cerrar-modal">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200">
                    Actualizar Estado
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Formulario oculto para cambiar estado -->
<form id="form-cambiar-estado" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="estado" id="nuevo-estado">
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM cargado - Inicializando gestión de usuarios...');

        // Botones para abrir modal crear
        const btnNuevoUsuario = document.getElementById('btn-nuevo-usuario');
        const btnCrearPrimerUsuario = document.getElementById('btn-crear-primer-usuario');

        if (btnNuevoUsuario) {
            btnNuevoUsuario.addEventListener('click', abrirModalCrear);
        }

        if (btnCrearPrimerUsuario) {
            btnCrearPrimerUsuario.addEventListener('click', abrirModalCrear);
        }

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

        // Validación de formulario en tiempo real
        const formCrear = document.querySelector('#modal-crear form');
        if (formCrear) {
            formCrear.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Las contraseñas no coinciden.');
                    return false;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    alert('La contraseña debe tener al menos 8 caracteres.');
                    return false;
                }
            });
        }

        // DEBUG: Agregar event listeners a todos los formularios
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                console.log('Formulario enviado:', this.action);
                console.log('Método:', this.method);
                console.log('Datos:', new FormData(this));
            });
        });

        console.log('Gestión de usuarios inicializada correctamente');
    });

    function abrirModalCrear() {
        console.log('Abriendo modal crear usuario...');
        document.getElementById('modal-crear').style.display = 'flex';
        // Limpiar formulario al abrir
        document.querySelector('#modal-crear form').reset();
    }

  function cambiarEstado(usuarioId, nuevoEstado) {
    console.log('=== CAMBIAR ESTADO INICIADO ===');
    console.log('Usuario ID:', usuarioId);
    console.log('Nuevo estado:', nuevoEstado);

    if (confirm('¿Estás seguro de cambiar el estado del usuario?')) {
        console.log('Usuario confirmó el cambio');

        // Crear formulario dinámico para cambiar estado
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/gestion-usuarios/${usuarioId}/estado`;
        console.log('Form action:', form.action);

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log('CSRF Token:', csrfToken);

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;

        const estadoInput = document.createElement('input');
        estadoInput.type = 'hidden';
        estadoInput.name = 'estado';
        estadoInput.value = nuevoEstado;

        form.appendChild(csrfInput);
        form.appendChild(estadoInput);
        document.body.appendChild(form);

        console.log('Formulario creado:', form);
        console.log('Enviando formulario...');

        form.submit();
    } else {
        console.log('Usuario canceló el cambio');
    }
}

function mostrarModalEstadoTecnico(usuarioId, estadoActual, observacionActual) {
    console.log('=== MODAL ESTADO TÉCNICO INICIADO ===');
    console.log('Usuario ID:', usuarioId);
    console.log('Estado actual:', estadoActual);
    console.log('Observación actual:', observacionActual);

    document.getElementById('estado_tecnico').value = estadoActual;
    document.getElementById('observacion').value = observacionActual;

    const form = document.getElementById('form-estado-tecnico');
    const actionUrl = `/gestion-usuarios/${usuarioId}/estado-tecnico`;
    form.action = actionUrl;

    console.log('Form action configurado:', actionUrl);
    console.log('Form actual:', form);

    document.getElementById('modal-estado-tecnico').style.display = 'flex';
    console.log('Modal mostrado');
}

    function confirmarEliminacion(usuarioId, usuarioNombre) {
        console.log('confirmarEliminacion llamado - usuarioId:', usuarioId, 'usuarioNombre:', usuarioNombre);
        document.getElementById('nombre-usuario').textContent = usuarioNombre;
        document.getElementById('form-eliminar').action = `/gestion-usuarios/${usuarioId}`;
        document.getElementById('modal-eliminar').style.display = 'flex';
    }

    function mostrarModalEstadoTecnico(usuarioId, estadoActual, observacionActual) {
        console.log('mostrarModalEstadoTecnico llamado - usuarioId:', usuarioId, 'estadoActual:', estadoActual);

        document.getElementById('estado_tecnico').value = estadoActual;
        document.getElementById('observacion').value = observacionActual;

        const form = document.getElementById('form-estado-tecnico');
        form.action = `/gestion-usuarios/${usuarioId}/estado-tecnico`;

        console.log('Formulario estado técnico configurado:', form.action);
        document.getElementById('modal-estado-tecnico').style.display = 'flex';
    }

    function cerrarTodosLosModales() {
        console.log('Cerrando todos los modales...');
        document.querySelectorAll('[id^="modal-"]').forEach(modal => {
            modal.style.display = 'none';
        });
    }

    // DEBUG: Función para probar las rutas
    function probarRutas() {
        console.log('=== DEBUG RUTAS ===');
        console.log('Ruta aprobar técnico:', '{{ route("gestion-usuarios.aprobar-tecnico", 1) }}');
        console.log('Ruta cambiar estado:', '{{ route("gestion-usuarios.estado", 1) }}');
        console.log('Ruta estado técnico:', '{{ route("gestion-usuarios.estado-tecnico", 1) }}');
        console.log('===================');
    }

    // Ejecutar prueba de rutas al cargar
    setTimeout(probarRutas, 1000);
</script>
@endsection
