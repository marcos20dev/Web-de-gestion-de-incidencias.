@extends('layouts.dashboard')

@section('title', 'Registrar Incidencia - Incidex')
@section('page-title', 'Registrar Incidencia')
@section('page-description', 'Reporta una nueva incidencia en el sistema')

@section('content')
    <div class="max-w-4xl mx-auto">
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
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <a href="{{ route('incidencias.mis') }}" class="ml-1 text-sm font-medium text-surface-400 hover:text-white transition duration-200">
                                Mis Incidencias
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-surface-600 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-white md:ml-2">Registrar Incidencia</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Formulario -->
        <div class="glass-effect rounded-2xl p-6 border border-surface-700">
            <form action="{{ route('incidencias.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Título -->
                    <div class="md:col-span-2">
                        <label for="titulo" class="block text-sm font-medium text-surface-200 mb-2">
                            <i class="fas fa-heading text-primary-400 mr-2"></i>
                            Título de la Incidencia *
                        </label>
                        <input type="text" id="titulo" name="titulo" required
                               class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                               placeholder="Ej: Error en el servidor de base de datos"
                               value="{{ old('titulo') }}">
                        @error('titulo')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoría -->
                    <div>
                        <label for="categoria_id" class="block text-sm font-medium text-surface-200 mb-2">
                            <i class="fas fa-tag text-primary-400 mr-2"></i>
                            Categoría *
                        </label>
                        <select id="categoria_id" name="categoria_id" required
                                class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200">
                            <option value="">Selecciona una categoría</option>
                            @foreach($categorias as $categoria)
                                @if($categoria->activo)
                                    <option value="{{ $categoria->id_categorias }}"
                                            {{ old('categoria_id') == $categoria->id_categorias ? 'selected' : '' }}
                                            data-color="{{ $categoria->color }}">
                                        {{ $categoria->nombre }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('categoria_id')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prioridad -->
                    <div>
                        <label for="prioridad" class="block text-sm font-medium text-surface-200 mb-2">
                            <i class="fas fa-exclamation-triangle text-primary-400 mr-2"></i>
                            Prioridad *
                        </label>
                        <select id="prioridad" name="prioridad" required
                                class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200">
                            <option value="media" {{ old('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
                            <option value="baja" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
                            <option value="alta" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
                            <option value="critica" {{ old('prioridad') == 'critica' ? 'selected' : '' }}>Crítica</option>
                        </select>
                        @error('prioridad')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ubicación -->
                    <div class="md:col-span-2">
                        <label for="ubicacion" class="block text-sm font-medium text-surface-200 mb-2">
                            <i class="fas fa-map-marker-alt text-primary-400 mr-2"></i>
                            Ubicación
                        </label>
                        <input type="text" id="ubicacion" name="ubicacion"
                               class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                               placeholder="Ej: Oficina 203, Piso 2"
                               value="{{ old('ubicacion') }}">
                        @error('ubicacion')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha Límite -->
                    <div class="md:col-span-2">
                        <label for="fecha_limite" class="block text-sm font-medium text-surface-200 mb-2">
                            <i class="fas fa-calendar-alt text-primary-400 mr-2"></i>
                            Fecha Límite (Opcional)
                        </label>
                        <input type="datetime-local" id="fecha_limite" name="fecha_limite"
                               class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                               value="{{ old('fecha_limite') }}"
                               min="{{ now()->format('Y-m-d\TH:i') }}">
                        @error('fecha_limite')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <label for="descripcion" class="block text-sm font-medium text-surface-200 mb-2">
                            <i class="fas fa-align-left text-primary-400 mr-2"></i>
                            Descripción Detallada *
                        </label>
                        <textarea id="descripcion" name="descripcion" rows="6" required
                                  class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200 resize-none"
                                  placeholder="Describe detalladamente el problema, incluyendo pasos para reproducirlo, mensajes de error, etc.">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-surface-700">
                    <a href="{{ route('incidencias.mis') }}"
                       class="px-6 py-3 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center space-x-2">
                        <i class="fas fa-plus-circle"></i>
                        <span>Registrar Incidencia</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prioridadSelect = document.getElementById('prioridad');
            const categoriaSelect = document.getElementById('categoria_id');
            const fechaLimiteInput = document.getElementById('fecha_limite');

            // Establecer fecha mínima como hoy
            const today = new Date().toISOString().slice(0, 16);
            fechaLimiteInput.min = today;

            // Cambiar color del borde según prioridad
            prioridadSelect.addEventListener('change', function() {
                const colors = {
                    'baja': 'border-green-500',
                    'media': 'border-yellow-500',
                    'alta': 'border-orange-500',
                    'critica': 'border-red-500'
                };

                // Remover clases anteriores
                Object.values(colors).forEach(color => {
                    prioridadSelect.classList.remove(color);
                });

                // Agregar nueva clase
                if (colors[this.value]) {
                    prioridadSelect.classList.add(colors[this.value]);
                }
            });

            // Cambiar color del borde según categoría seleccionada
            categoriaSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const color = selectedOption.getAttribute('data-color');

                // Remover clases de color anteriores
                categoriaSelect.classList.remove('border-blue-500', 'border-green-500', 'border-red-500',
                    'border-yellow-500', 'border-purple-500', 'border-pink-500',
                    'border-indigo-500', 'border-teal-500', 'border-orange-500');

                // Agregar borde con el color de la categoría
                if (color && selectedOption.value !== '') {
                    categoriaSelect.style.borderColor = color;
                } else {
                    categoriaSelect.style.borderColor = ''; // Volver al color por defecto
                }
            });

            // Trigger inicial para prioridad
            prioridadSelect.dispatchEvent(new Event('change'));

            // Trigger inicial para categoría si ya hay una seleccionada
            if (categoriaSelect.value) {
                categoriaSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
