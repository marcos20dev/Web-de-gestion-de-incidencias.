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
        <!-- Dashboard -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-home w-5 text-center"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Registrar Incidencia -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('incidencias.create') ? 'active' : '' }}">
            <a href="{{ route('incidencias.create') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-plus-circle w-5 text-center"></i>
                <span>Registrar Incidencia</span>
            </a>
        </div>

        <!-- Mis Incidencias -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('incidencias.mis') ? 'active' : '' }}">
            <a href="{{ route('incidencias.mis') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-tasks w-5 text-center"></i>
                <span>Mis Incidencias</span>
            </a>
        </div>

        <!-- Incidencias Asignadas -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('incidencias.asignadas') ? 'active' : '' }}">
            <a href="{{ route('incidencias.asignadas') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-list-check w-5 text-center"></i>
                <span>Incidencias Asignadas</span>
            </a>
        </div>

        <!-- Todas las Incidencias -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('incidencias.todas') ? 'active' : '' }}">
            <a href="{{ route('incidencias.todas') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-list w-5 text-center"></i>
                <span>Todas las Incidencias</span>
            </a>
        </div>

        <!-- Separador -->
        <div class="border-t border-surface-700 my-4"></div>

        <!-- Gestión de Usuarios -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('gestion-usuarios.*') ? 'active' : '' }}">
            <a href="{{ route('gestion-usuarios.index') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-user-cog w-5 text-center"></i>
                <span>Gestión de Usuarios</span>
            </a>
        </div>

        <!-- Gestión de Roles -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('gestion-roles.*') ? 'active' : '' }}">
            <a href="{{ route('gestion-roles.index') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-user-tag w-5 text-center"></i>
                <span>Gestión de Roles</span>
            </a>
        </div>

        <!-- Categorías -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
            <a href="{{ route('categorias.index') }}" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-tags w-5 text-center"></i>
                <span>Categorías</span>
            </a>
        </div>

        <!-- Usuarios -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
            <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-users w-5 text-center"></i>
                <span>Usuarios</span>
            </a>
        </div>

        <!-- Roles -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('roles.*') ? 'active' : '' }}">
            <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
                <i class="fas fa-user-tag w-5 text-center"></i>
                <span>Roles</span>
            </a>
        </div>

        <!-- Reportes -->
        <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('reportes.*') ? 'active' : '' }}">
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
                <span class="text-white text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}{{ strtoupper(substr(Auth::user()->apellido_paterno, 0, 1)) }}
                </span>
            </div>
            <div class="flex-1">
                <p class="text-sm text-white font-medium">{{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}</p>
                <p class="text-xs text-surface-400 capitalize">{{ Auth::user()->rol }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-surface-400 hover:text-white transition duration-200">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>
