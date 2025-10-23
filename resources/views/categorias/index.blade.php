@extends('layouts.dashboard')

@section('title', 'Categorías - Incidex')
@section('page-title', 'Gestión de Categorías')
@section('page-description', 'Administra las categorías para organizar las incidencias')

@section('content')
    <div class="max-w-8xl mx-auto">
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
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Categorías</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Contenedor Principal -->
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-6">

            <!-- Columna Izquierda - Formulario (más angosto) -->
            <div class="xl:col-span-1 space-y-6">
                <!-- Header del Formulario -->
                <div class="flex justify-between items-center">
                    <div>
                        <h3 id="form-title" class="text-xl font-bold text-white @if(request()->has('editar')) text-yellow-400 @endif">
                            @if(request()->has('editar'))
                                Editando Categoría
                            @else
                                Crear Nueva Categoría
                            @endif
                        </h3>
                        <p id="form-subtitle" class="text-surface-400">
                            @if(request()->has('editar'))
                                Modifica los datos de la categoría
                            @else
                                Completa los datos para crear una nueva categoría
                            @endif
                        </p>
                    </div>
                    @if(request()->has('editar'))
                        <a href="{{ route('categorias.index') }}"
                           class="px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200">
                            <i class="fas fa-times mr-2"></i>Cancelar
                        </a>
                    @endif
                </div>

                <!-- Formulario -->
                <div class="glass-effect rounded-2xl p-6 border border-surface-700">
                    @if(request()->has('editar') && $categoriaEditar)
                        <!-- Formulario de Edición -->
                        <form method="POST" action="{{ route('categorias.update', $categoriaEditar) }}">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label for="nombre_edit" class="block text-sm font-medium text-white mb-2">Nombre *</label>
                                    <input type="text" id="nombre_edit" name="nombre"
                                           class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                                           value="{{ old('nombre', $categoriaEditar->nombre) }}"
                                           required>
                                    @error('nombre')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="descripcion_edit" class="block text-sm font-medium text-white mb-2">Descripción</label>
                                    <textarea id="descripcion_edit" name="descripcion" rows="3"
                                              class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                                              placeholder="Describe el propósito de esta categoría...">{{ old('descripcion', $categoriaEditar->descripcion) }}</textarea>
                                    @error('descripcion')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="color_edit" class="block text-sm font-medium text-white mb-2">Color *</label>
                                    <div class="flex items-center space-x-4">
                                        <input type="color" id="color_edit" name="color"
                                               class="w-12 h-12 rounded-xl cursor-pointer bg-surface-800 border border-surface-600"
                                               value="{{ old('color', $categoriaEditar->color) }}"
                                               required>
                                        <div class="flex-1">
                                            <input type="text" id="color_text_edit"
                                                   class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                                                   value="{{ old('color', $categoriaEditar->color) }}"
                                                   required>
                                        </div>
                                    </div>
                                    @error('color')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex space-x-3 pt-4">
                                    <button type="submit"
                                            class="flex-1 px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-medium rounded-xl transition duration-200">
                                        <i class="fas fa-save mr-2"></i>
                                        <span>Guardar Cambios</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <!-- Formulario de Creación -->
                        <form method="POST" action="{{ route('categorias.store') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-white mb-2">Nombre *</label>
                                    <input type="text" id="nombre" name="nombre"
                                           class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                                           placeholder="Ej: Hardware, Software, Red..."
                                           value="{{ old('nombre') }}"
                                           required>
                                    @error('nombre')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="descripcion" class="block text-sm font-medium text-white mb-2">Descripción</label>
                                    <textarea id="descripcion" name="descripcion" rows="3"
                                              class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                                              placeholder="Describe el propósito de esta categoría...">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="color" class="block text-sm font-medium text-white mb-2">Color *</label>
                                    <div class="flex items-center space-x-4">
                                        <input type="color" id="color" name="color"
                                               class="w-12 h-12 rounded-xl cursor-pointer bg-surface-800 border border-surface-600"
                                               value="{{ old('color', '#3B82F6') }}"
                                               required>
                                        <div class="flex-1">
                                            <input type="text" id="color_text"
                                                   class="w-full px-4 py-3 bg-surface-800 border border-surface-600 rounded-xl text-white placeholder-surface-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition duration-200"
                                                   placeholder="#3B82F6"
                                                   value="{{ old('color', '#3B82F6') }}"
                                                   required>
                                        </div>
                                    </div>
                                    @error('color')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sugerencias Rápidas -->
                                @if(isset($categoriasSugeridas) && count($categoriasSugeridas) > 0)
                                    <div>
                                        <label class="block text-sm font-medium text-white mb-2">Sugerencias Rápidas</label>
                                        <div class="grid grid-cols-1 gap-2 max-h-32 overflow-y-auto">
                                            @foreach($categoriasSugeridas as $nombre => $descripcion)
                                                <button type="button"
                                                        class="text-left p-3 bg-surface-800 hover:bg-surface-700 border border-surface-600 rounded-xl text-surface-300 hover:text-white transition duration-200 text-sm"
                                                        onclick="document.getElementById('nombre').value='{{ $nombre }}'; document.getElementById('descripcion').value='{{ $descripcion }}'; document.getElementById('nombre').focus();">
                                                    <div class="font-medium text-white">{{ $nombre }}</div>
                                                    <div class="text-xs text-surface-400 mt-1">{{ Str::limit($descripcion, 50) }}</div>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="flex space-x-3 pt-4">
                                    <button type="submit"
                                            class="flex-1 px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)]">
                                        <i class="fas fa-plus-circle mr-2"></i>
                                        <span>Crear Categoría</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Columna Derecha - Tabla (más ancha) -->
            <div class="xl:col-span-3 space-y-6">
                <!-- Header de la Tabla -->
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-white">Lista de Categorías</h3>
                        <p class="text-surface-400">{{ $categorias->count() }} categorías encontradas</p>
                    </div>
                </div>

                <!-- Tabla de Categorías -->
                <div class="glass-effect rounded-2xl border border-surface-700 overflow-hidden">
                    @if($categorias->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr class="text-left text-surface-400 text-sm border-b border-surface-700 bg-surface-800/50">
                                    <th class="px-6 py-4 font-medium">Color</th>
                                    <th class="px-6 py-4 font-medium">Nombre</th>
                                    <th class="px-6 py-4 font-medium">Descripción</th>
                                    <th class="px-6 py-4 font-medium text-center">Estado</th>
                                    <th class="px-6 py-4 font-medium text-center">Incidencias</th>
                                    <th class="px-6 py-4 font-medium text-center">Creado</th>
                                    <th class="px-6 py-4 font-medium text-right">Acciones</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-surface-700">
                                @foreach($categorias as $categoria)
                                    <tr class="text-sm hover:bg-surface-800/30 transition duration-200 {{ request()->has('editar') && request('editar') == $categoria->id_categorias ? 'bg-yellow-500/10' : '' }}">
                                        <td class="px-6 py-4">
                                            <div class="w-8 h-8 rounded-lg border-2"
                                                 style="background-color: {{ $categoria->color }}; border-color: {{ $categoria->color }}20">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-white font-medium">{{ $categoria->nombre }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-surface-300">
                                            <p class="max-w-md">{{ $categoria->descripcion ?: 'Sin descripción' }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center">
                                                <button type="button"
                                                        onclick="toggleEstado({{ $categoria->id_categorias }}, this)"
                                                        class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 {{ $categoria->activo ? 'bg-primary-500' : 'bg-surface-600' }}"
                                                        data-estado="{{ $categoria->activo ? '1' : '0' }}">
                                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-200 {{ $categoria->activo ? 'translate-x-6' : 'translate-x-1' }}"></span>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-surface-300 text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 bg-surface-700 rounded-full text-sm font-medium">
                                                {{ $categoria->incidencias->count() }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-surface-300 text-center">
                                            {{ $categoria->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end space-x-2">
                                                <!-- Botón Editar -->
                                                <a href="{{ route('categorias.index', ['editar' => $categoria->id_categorias]) }}"
                                                   class="p-2 text-surface-400 hover:text-yellow-400 transition duration-200 rounded-lg hover:bg-yellow-400/10"
                                                   title="Editar categoría">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Botón Eliminar -->
                                                @if($categoria->incidencias->count() === 0)
                                                    <button type="button"
                                                            onclick="confirmarEliminacion({{ $categoria->id_categorias }})"
                                                            class="p-2 text-surface-400 hover:text-red-400 transition duration-200 rounded-lg hover:bg-red-400/10"
                                                            title="Eliminar categoría">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @else
                                                    <button class="p-2 text-surface-600 cursor-not-allowed"
                                                            title="No se puede eliminar (tiene incidencias)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- Estado vacío -->
                        <div class="text-center py-12">
                            <div class="w-24 h-24 mx-auto mb-4 bg-surface-800/50 rounded-full flex items-center justify-center">
                                <i class="fas fa-tags text-surface-400 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">No hay categorías</h3>
                            <p class="text-surface-400 mb-6">Comienza creando tu primera categoría.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Eliminar -->
    <div id="modal-eliminar" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="glass-effect rounded-2xl p-6 border border-surface-700 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">¿Eliminar Categoría?</h3>
                <p class="text-surface-400 mb-6">Esta acción no se puede deshacer. La categoría se eliminará permanentemente.</p>

                <div class="flex space-x-3">
                    <button type="button"
                            onclick="cerrarModal()"
                            class="flex-1 px-4 py-2 bg-surface-700 hover:bg-surface-600 text-white font-medium rounded-xl transition duration-200">
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

    <!-- Formulario oculto para eliminación -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
    <script>
        // Sincronizar inputs de color para creación
        document.getElementById('color')?.addEventListener('input', function(e) {
            document.getElementById('color_text').value = e.target.value;
        });

        document.getElementById('color_text')?.addEventListener('input', function(e) {
            if (e.target.value.match(/^#[0-9A-F]{6}$/i)) {
                document.getElementById('color').value = e.target.value;
            }
        });

        // Sincronizar inputs de color para edición
        document.getElementById('color_edit')?.addEventListener('input', function(e) {
            document.getElementById('color_text_edit').value = e.target.value;
        });

        document.getElementById('color_text_edit')?.addEventListener('input', function(e) {
            if (e.target.value.match(/^#[0-9A-F]{6}$/i)) {
                document.getElementById('color_edit').value = e.target.value;
            }
        });

        // Toggle estado de categoría
        function toggleEstado(categoriaId, button) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = `/categorias/${categoriaId}/estado`;

            // Cambiar estado visualmente inmediatamente
            const isActive = button.getAttribute('data-estado') === '1';
            const newState = !isActive;

            // Actualizar visualmente
            button.setAttribute('data-estado', newState ? '1' : '0');
            button.classList.toggle('bg-primary-500', newState);
            button.classList.toggle('bg-surface-600', !newState);

            const span = button.querySelector('span');
            span.classList.toggle('translate-x-6', newState);
            span.classList.toggle('translate-x-1', !newState);

            // Hacer la peticación AJAX
            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'PUT'
                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.success) {
                        // Revertir cambios si hay error
                        button.setAttribute('data-estado', isActive ? '1' : '0');
                        button.classList.toggle('bg-primary-500', isActive);
                        button.classList.toggle('bg-surface-600', !isActive);

                        span.classList.toggle('translate-x-6', isActive);
                        span.classList.toggle('translate-x-1', !isActive);

                        console.error('Error:', data.message);
                    }
                })
                .catch(error => {
                    // Revertir cambios si hay error
                    button.setAttribute('data-estado', isActive ? '1' : '0');
                    button.classList.toggle('bg-primary-500', isActive);
                    button.classList.toggle('bg-surface-600', !isActive);

                    span.classList.toggle('translate-x-6', isActive);
                    span.classList.toggle('translate-x-1', !isActive);

                    console.error('Error:', error);
                });
        }

        // Modal de eliminación
        function confirmarEliminacion(categoriaId) {
            const form = document.getElementById('delete-form');
            form.action = `/categorias/${categoriaId}`;

            document.getElementById('form-eliminar').action = `/categorias/${categoriaId}`;
            document.getElementById('modal-eliminar').classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modal-eliminar').classList.add('hidden');
        }

        // Cerrar modal con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal();
            }
        });

        // Cerrar modal haciendo click fuera
        document.getElementById('modal-eliminar').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });
    </script>
@endpush
