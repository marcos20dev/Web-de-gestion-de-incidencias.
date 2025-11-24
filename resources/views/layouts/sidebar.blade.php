<div class="w-64 bg-gradient-to-b from-surface-900 to-surface-800 border-r border-surface-700 flex flex-col shadow-lg">
    <!-- Logo Section -->
    <div class="p-6 border-b border-surface-700 bg-surface-800/50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-md">
                <i class="fas fa-shield-alt text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">Incidex</h1>
                <p class="text-xs text-surface-400">Sistema v2.1</p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 p-4 space-y-1">
        @php
            // Separar el dashboard del resto de permisos
            $dashboard = null;
            $otrosPermisos = [];

            foreach($permisos as $permiso) {
                if($permiso->slug === 'dashboard' || stripos($permiso->nombre, 'dashboard') !== false) {
                    $dashboard = $permiso;
                } else {
                    $otrosPermisos[] = $permiso;
                }
            }

            // Si no encontramos dashboard por slug o nombre, tomamos el primero
            if(!$dashboard && count($permisos) > 0) {
                $dashboard = $permisos[0];
                array_shift($otrosPermisos);
            }
        @endphp

        <!-- Dashboard siempre primero -->
        @if($dashboard && isset($permisos_rutas[$dashboard->slug]))
            @php
                $currentPath = request()->path();
                $dashboardPath = trim(parse_url($permisos_rutas[$dashboard->slug], PHP_URL_PATH), '/');
                $isDashboardActive = $currentPath === $dashboardPath || str_starts_with($currentPath, $dashboardPath . '/');
            @endphp

            <div class="transition-all duration-300 rounded-lg {{ $isDashboardActive ? 'bg-primary-500/20 border-l-4 border-primary-500' : 'hover:bg-surface-700/50' }}">
                <a href="{{ $permisos_rutas[$dashboard->slug] }}"
                   class="flex items-center space-x-3 px-4 py-3 transition-colors duration-200 {{ $isDashboardActive ? 'text-white' : 'text-surface-300 hover:text-white' }}">
                    <i class="{{ $dashboard->icono ?: 'fas fa-tachometer-alt' }} w-5 text-center {{ $isDashboardActive ? 'text-primary-400' : 'text-surface-400' }}"></i>
                    <span class="font-medium">{{ $dashboard->nombre }}</span>

                    @if($isDashboardActive)
                        <div class="ml-auto w-2 h-2 bg-primary-500 rounded-full animate-pulse"></div>
                    @endif
                </a>
            </div>
        @endif

        <!-- Ordenar el resto de permisos alfabéticamente -->
        @php
            // Ordenar alfabéticamente por nombre
            usort($otrosPermisos, function($a, $b) {
                return strcmp($a->nombre, $b->nombre);
            });
        @endphp

        @foreach($otrosPermisos as $permiso)
            @if(isset($permisos_rutas[$permiso->slug]))
                @php
                    $currentPath = request()->path();
                    $permisoPath = trim(parse_url($permisos_rutas[$permiso->slug], PHP_URL_PATH), '/');
                    $isActive = $currentPath === $permisoPath || str_starts_with($currentPath, $permisoPath . '/');
                @endphp

                <div class="transition-all duration-300 rounded-lg {{ $isActive ? 'bg-primary-500/20 border-l-4 border-primary-500' : 'hover:bg-surface-700/50' }}">
                    <a href="{{ $permisos_rutas[$permiso->slug] }}"
                       class="flex items-center space-x-3 px-4 py-3 transition-colors duration-200 {{ $isActive ? 'text-white' : 'text-surface-300 hover:text-white' }}">
                        <i class="{{ $permiso->icono }} w-5 text-center {{ $isActive ? 'text-primary-400' : 'text-surface-400' }}"></i>
                        <span class="font-medium">{{ $permiso->nombre }}</span>

                        @if($isActive)
                            <div class="ml-auto w-2 h-2 bg-primary-500 rounded-full animate-pulse"></div>
                        @endif
                    </a>

                    {{-- Sub-items --}}
                    @if(isset($permiso->subpermisos) && count($permiso->subpermisos) > 0)
                        @php
                            // Ordenar subpermisos alfabéticamente
                            usort($permiso->subpermisos, function($a, $b) {
                                return strcmp($a->nombre, $b->nombre);
                            });
                        @endphp

                        <div class="ml-6 mt-1 space-y-1">
                            @foreach($permiso->subpermisos as $sub)
                                @php
                                    $subPath = trim(parse_url($permisos_rutas[$sub->slug], PHP_URL_PATH), '/');
                                    $subActive = $currentPath === $subPath || str_starts_with($currentPath, $subPath . '/');
                                @endphp
                                <a href="{{ $permisos_rutas[$sub->slug] }}"
                                   class="block px-4 py-2 rounded-lg transition duration-200 {{ $subActive ? 'bg-primary-500/30 text-white' : 'hover:bg-surface-700/50 text-surface-300 hover:text-white' }}">
                                    {{ $sub->nombre }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </nav>

    <!-- Footer Sidebar -->
    <div class="p-4 border-t border-surface-700">
        <div class="flex items-center space-x-3 p-3 bg-surface-800/50 rounded-lg hover:bg-surface-700/50 transition duration-200">
            <div class="w-8 h-8 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center shadow-sm">
                <span class="text-white text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}{{ strtoupper(substr(Auth::user()->apellido_paterno, 0, 1)) }}
                </span>
            </div>
            <div class="flex-1">
                <p class="text-sm text-white font-medium">{{ Auth::user()->nombre }} {{ Auth::user()->apellido_paterno }}</p>
                <p class="text-xs text-surface-400 capitalize">{{ Auth::user()->rol->nombre }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-surface-400 hover:text-red-400 transition duration-200 p-2 rounded-lg hover:bg-surface-700">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>
