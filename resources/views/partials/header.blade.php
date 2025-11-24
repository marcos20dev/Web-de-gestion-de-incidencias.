<header class="bg-surface-800 border-b border-surface-700 p-4">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-white">@yield('page-title', 'Dashboard')</h2>
            <p class="text-surface-400 text-sm">@yield('page-description', 'Resumen general del sistema de incidencias')</p>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Notificaciones -->
            <div class="relative">
                <button class="text-surface-400 hover:text-white transition duration-200">
                    <i class="fas fa-bell"></i>
                </button>
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
            </div>

            <!-- Información del Usuario -->
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-sm text-white font-medium">
                        {{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}
                    </p>
                    <p class="text-xs text-surface-400 capitalize">
                        {{ Auth::user()->rol?->nombre ?? 'Sin rol' }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center">
                    <span class="text-white text-sm font-bold">
                        {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}{{ strtoupper(substr(Auth::user()->apellido_paterno, 0, 1)) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
