@extends('layouts.dashboard')

@section('title', 'Registrar Incidencia - Incidex')
@section('page-title', 'Registrar Incidencia')
@section('page-description', 'Reporta una nueva incidencia en el sistema')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumbs -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center text-sm font-medium text-slate-400 hover:text-white transition-all duration-300 group">
                            <div class="w-8 h-8 bg-slate-800/50 rounded-lg flex items-center justify-center mr-2 group-hover:bg-primary-500/20 transition-colors duration-300">
                                <i class="fas fa-home text-slate-400 group-hover:text-primary-400"></i>
                            </div>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                            <a href="{{ route('incidencias.mis') }}"
                               class="text-sm font-medium text-slate-400 hover:text-white transition-colors duration-300">
                                Mis Incidencias
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-slate-600 mx-2 text-xs"></i>
                            <span class="ml-1 text-sm font-medium text-primary-400 bg-primary-500/10 px-3 py-1 rounded-full border border-primary-500/20">
                                Registrar Incidencia
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header -->
        <div class="mb-8 transform transition-all duration-500 hover:scale-[1.01]">
            <div class="relative bg-gradient-to-r from-slate-900 via-slate-800 to-primary-900/30 rounded-2xl shadow-2xl overflow-hidden border border-slate-700/50 backdrop-blur-xl">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 to-emerald-500/5"></div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-emerald-500/10 rounded-full translate-y-12 -translate-x-12"></div>

                <div class="relative p-8">
                    <div class="flex items-center space-x-6">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary-500 to-emerald-600 rounded-2xl blur-lg opacity-30"></div>
                            <div class="relative bg-gradient-to-br from-primary-500/20 to-emerald-500/20 p-5 rounded-2xl border border-primary-500/30 shadow-lg backdrop-blur-sm">
                                <i class="fas fa-plus-circle text-primary-400 text-3xl"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h1 class="text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight">
                                Registrar Nueva Incidencia
                            </h1>
                            <p class="text-slate-300 text-lg">
                                Completa todos los campos para reportar un problema en el sistema
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario Mejorado -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Columna Izquierda - Información Básica -->
            <div class="xl:col-span-2">
                <div class="glass-effect rounded-2xl p-8 border border-slate-700/50 backdrop-blur-xl">
                    <form action="{{ route('incidencias.store') }}" method="POST" enctype="multipart/form-data" id="incidenciaForm" class="space-y-8">
                        @csrf

                        <!-- Título -->
                        <div class="group relative">
                            <label for="titulo" class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-primary-500/20 rounded-lg flex items-center justify-center mr-3 border border-primary-500/30">
                                    <i class="fas fa-heading text-primary-400"></i>
                                </div>
                                Título de la Incidencia *
                            </label>
                            <input type="text" id="titulo" name="titulo" required
                                   class="w-full px-6 py-4 bg-slate-800/50 text-white text-lg border border-slate-600 rounded-2xl placeholder-slate-500 focus:outline-none focus:border-primary-500 focus:ring-4 focus:ring-primary-500/20 transition-all duration-300 hover:border-slate-500"
                                   placeholder="Ej: Error en el servidor de base de datos"
                                   value="{{ old('titulo') }}">
                            @error('titulo')
                            <p class="text-red-400 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Grid de Campos Básicos -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Categoría -->
                            <div class="group relative">
                                <label for="categoria_id" class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                    <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center mr-3 border border-purple-500/30">
                                        <i class="fas fa-tag text-purple-400"></i>
                                    </div>
                                    Categoría *
                                </label>
                                <select id="categoria_id" name="categoria_id" required
                                        class="w-full px-6 py-4 bg-slate-800/50 text-white text-lg border border-slate-600 rounded-2xl focus:outline-none focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all duration-300 hover:border-slate-500">
                                    <option value="" class="text-slate-500">Selecciona una categoría</option>
                                    @foreach($categorias as $categoria)
                                        @if($categoria->activo)
                                            <option value="{{ $categoria->id_categorias }}"
                                                    {{ old('categoria_id') == $categoria->id_categorias ? 'selected' : '' }}
                                                    data-color="{{ $categoria->color }}"
                                                    class="text-white">
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                <p class="text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Prioridad -->
                            <div class="group relative">
                                <label for="prioridad" class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                    <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3 border border-orange-500/30">
                                        <i class="fas fa-exclamation-triangle text-orange-400"></i>
                                    </div>
                                    Prioridad *
                                </label>
                                <select id="prioridad" name="prioridad" required
                                        class="w-full px-6 py-4 bg-slate-800/50 text-white text-lg border border-slate-600 rounded-2xl focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/20 transition-all duration-300 hover:border-slate-500">
                                    <option value="media" {{ old('prioridad') == 'media' ? 'selected' : '' }} class="text-yellow-400">🟡 Media</option>
                                    <option value="baja" {{ old('prioridad') == 'baja' ? 'selected' : '' }} class="text-green-400">🟢 Baja</option>
                                    <option value="alta" {{ old('prioridad') == 'alta' ? 'selected' : '' }} class="text-orange-400">🟠 Alta</option>
                                    <option value="critica" {{ old('prioridad') == 'critica' ? 'selected' : '' }} class="text-red-400">🔴 Crítica</option>
                                </select>
                                @error('prioridad')
                                <p class="text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Ubicación -->
                        <div class="group relative">
                            <label for="ubicacion" class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center mr-3 border border-blue-500/30">
                                    <i class="fas fa-map-marker-alt text-blue-400"></i>
                                </div>
                                Ubicación
                            </label>
                            <input type="text" id="ubicacion" name="ubicacion"
                                   class="w-full px-6 py-4 bg-slate-800/50 text-white text-lg border border-slate-600 rounded-2xl placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 hover:border-slate-500"
                                   placeholder="Ej: Oficina 203, Piso 2, Edificio Principal"
                                   value="{{ old('ubicacion') }}">
                            @error('ubicacion')
                            <p class="text-red-400 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Grid de Campos Adicionales -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Fecha Límite -->
                            <div class="group relative">
                                <label for="fecha_limite" class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                    <div class="w-10 h-10 bg-cyan-500/20 rounded-lg flex items-center justify-center mr-3 border border-cyan-500/30">
                                        <i class="fas fa-calendar-alt text-cyan-400"></i>
                                    </div>
                                    Fecha Límite
                                </label>
                                <input type="datetime-local" id="fecha_limite" name="fecha_limite"
                                       class="w-full px-6 py-4 bg-slate-800/50 text-white text-lg border border-slate-600 rounded-2xl focus:outline-none focus:border-cyan-500 focus:ring-4 focus:ring-cyan-500/20 transition-all duration-300 hover:border-slate-500"
                                       value="{{ old('fecha_limite') }}"
                                       min="{{ now()->format('Y-m-d\TH:i') }}">
                                @error('fecha_limite')
                                <p class="text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Imagen de Evidencia -->
                            <div class="group relative">
                                <label for="imagen_evidencia" class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                    <div class="w-10 h-10 bg-pink-500/20 rounded-lg flex items-center justify-center mr-3 border border-pink-500/30">
                                        <i class="fas fa-image text-pink-400"></i>
                                    </div>
                                    Imagen de Evidencia
                                </label>
                                <input type="file" id="imagen_evidencia" name="imagen_evidencia"
                                       accept="image/*"
                                       class="w-full px-6 py-4 bg-slate-800/50 text-white text-lg border border-slate-600 rounded-2xl focus:outline-none focus:border-pink-500 focus:ring-4 focus:ring-pink-500/20 transition-all duration-300 hover:border-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-base file:font-semibold file:bg-pink-500 file:text-white hover:file:bg-pink-600 file:transition-colors file:duration-300">
                                @error('imagen_evidencia')
                                <p class="text-red-400 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                </p>
                                @enderror
                                <p class="text-sm text-slate-400 mt-3 flex items-center">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Formatos: JPG, PNG, GIF. Máximo 5MB
                                </p>
                            </div>
                        </div>

                        <!-- Vista previa de imagen -->
                        <div class="hidden" id="preview-container">
                            <label class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-emerald-500/20 rounded-lg flex items-center justify-center mr-3 border border-emerald-500/30">
                                    <i class="fas fa-eye text-emerald-400"></i>
                                </div>
                                Vista Previa
                            </label>
                            <div class="border-2 border-dashed border-slate-600 rounded-2xl p-6 bg-slate-800/30">
                                <img id="image-preview" class="max-w-full max-h-80 mx-auto rounded-xl shadow-lg">
                                <button type="button" id="remove-image"
                                        class="mt-4 px-6 py-3 bg-red-500/20 text-red-300 border border-red-500/30 rounded-xl hover:bg-red-500/30 transition-all duration-300 flex items-center space-x-2 mx-auto">
                                    <i class="fas fa-times"></i>
                                    <span>Eliminar imagen</span>
                                </button>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="group relative">
                            <label for="descripcion" class="block text-lg font-semibold text-slate-200 mb-4 flex items-center">
                                <div class="w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center mr-3 border border-indigo-500/30">
                                    <i class="fas fa-align-left text-indigo-400"></i>
                                </div>
                                Descripción Detallada *
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="8" required
                                      class="w-full px-6 py-4 bg-slate-800/50 text-white text-lg border border-slate-600 rounded-2xl placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-300 hover:border-slate-500 resize-none"
                                      placeholder="Describe detalladamente el problema, incluyendo:
• Pasos para reproducirlo
• Mensajes de error específicos
• Comportamiento esperado vs actual
• Cualquier información relevante">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                            <p class="text-red-400 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex items-center justify-end space-x-6 pt-8 border-t border-slate-700/50">
                            <a href="{{ route('incidencias.mis') }}"
                               class="px-8 py-4 bg-slate-800/50 text-slate-300 border border-slate-600 rounded-2xl hover:bg-slate-700/50 hover:border-slate-500 transition-all duration-300 flex items-center space-x-3 group">
                                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform duration-300"></i>
                                <span class="font-semibold">Cancelar</span>
                            </a>
                            <button type="submit"
                                    class="px-8 py-4 bg-gradient-to-r from-primary-500 to-emerald-600 hover:from-primary-600 hover:to-emerald-700 text-white rounded-2xl font-semibold transition-all duration-300 shadow-[0_0_30px_rgba(74,222,128,0.3)] hover:shadow-[0_0_40px_rgba(74,222,128,0.5)] flex items-center space-x-3 group transform hover:scale-105">
                                <i class="fas fa-plus-circle group-hover:scale-110 group-hover:rotate-12 transition-transform duration-300"></i>
                                <span class="text-lg">Registrar Incidencia</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Columna Derecha - Información y Guías -->
            <div class="space-y-8">
                <!-- Tarjeta de Información -->
                <div class="glass-effect rounded-2xl p-6 border border-slate-700/50 backdrop-blur-xl">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                        <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center mr-3 border border-blue-500/30">
                            <i class="fas fa-info-circle text-blue-400"></i>
                        </div>
                        Información Importante
                    </h3>
                    <div class="space-y-4 text-slate-300">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-asterisk text-red-400 mt-1 text-xs"></i>
                            <span class="text-sm">Los campos marcados con * son obligatorios</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-clock text-yellow-400 mt-1"></i>
                            <span class="text-sm">La incidencia será revisada por un supervisor</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-user-cog text-green-400 mt-1"></i>
                            <span class="text-sm">Se te asignará un técnico especializado</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-bell text-purple-400 mt-1"></i>
                            <span class="text-sm">Recibirás notificaciones del progreso</span>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Prioridades -->
                <div class="glass-effect rounded-2xl p-6 border border-slate-700/50 backdrop-blur-xl">
                    <h3 class="text-xl font-bold text-white mb-4 flex items-center">
                        <div class="w-8 h-8 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3 border border-orange-500/30">
                            <i class="fas fa-flag text-orange-400"></i>
                        </div>
                        Niveles de Prioridad
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-red-500/10 rounded-xl border border-red-500/20">
                            <span class="text-red-300 font-medium">Crítica</span>
                            <span class="text-red-400 text-sm">Máxima urgencia</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-orange-500/10 rounded-xl border border-orange-500/20">
                            <span class="text-orange-300 font-medium">Alta</span>
                            <span class="text-orange-400 text-sm">Alta urgencia</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-yellow-500/10 rounded-xl border border-yellow-500/20">
                            <span class="text-yellow-300 font-medium">Media</span>
                            <span class="text-yellow-400 text-sm">Urgencia normal</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-500/10 rounded-xl border border-green-500/20">
                            <span class="text-green-300 font-medium">Baja</span>
                            <span class="text-green-400 text-sm">Baja urgencia</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prioridadSelect = document.getElementById('prioridad');
    const categoriaSelect = document.getElementById('categoria_id');
    const fechaLimiteInput = document.getElementById('fecha_limite');
    const imagenInput = document.getElementById('imagen_evidencia');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');
    const removeImageBtn = document.getElementById('remove-image');

    // Establecer fecha mínima como hoy
    const today = new Date().toISOString().slice(0, 16);
    fechaLimiteInput.min = today;

    // Cambiar color del borde según prioridad
    prioridadSelect.addEventListener('change', function() {
        const colors = {
            'baja': 'focus:border-green-500 focus:ring-green-500/20',
            'media': 'focus:border-yellow-500 focus:ring-yellow-500/20',
            'alta': 'focus:border-orange-500 focus:ring-orange-500/20',
            'critica': 'focus:border-red-500 focus:ring-red-500/20'
        };

        // Remover clases anteriores
        Object.values(colors).forEach(color => {
            prioridadSelect.classList.remove(...color.split(' '));
        });

        // Agregar nueva clase
        if (colors[this.value]) {
            prioridadSelect.classList.add(...colors[this.value].split(' '));
        }
    });

    // Cambiar color del borde según categoría seleccionada
    categoriaSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const color = selectedOption.getAttribute('data-color');

        // Remover clases de color anteriores
        const focusClasses = ['focus:border-blue-500', 'focus:border-purple-500', 'focus:border-green-500',
                            'focus:border-red-500', 'focus:border-yellow-500', 'focus:border-pink-500',
                            'focus:border-indigo-500', 'focus:border-teal-500', 'focus:border-orange-500'];
        focusClasses.forEach(cls => categoriaSelect.classList.remove(cls));

        // Agregar borde con el color de la categoría
        if (color && selectedOption.value !== '') {
            categoriaSelect.style.setProperty('--tw-border-opacity', '1');
            categoriaSelect.style.borderColor = color;
            categoriaSelect.classList.add('focus:border-[color:var(--tw-border-color)]');
        } else {
            categoriaSelect.style.borderColor = '';
        }
    });

    // Vista previa de imagen
    imagenInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire({
                    title: 'Archivo muy grande',
                    text: 'La imagen es demasiado grande. Máximo 5MB permitido.',
                    icon: 'warning',
                    confirmButtonColor: '#10b981',
                    background: '#1f2937',
                    color: '#f9fafb'
                });
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // Eliminar imagen
    removeImageBtn.addEventListener('click', function() {
        imagenInput.value = '';
        previewContainer.classList.add('hidden');
        imagePreview.src = '';
    });

    // Efectos de hover en grupos
    const formGroups = document.querySelectorAll('.group');
    formGroups.forEach(group => {
        group.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });
        group.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // Trigger inicial para prioridad
    prioridadSelect.dispatchEvent(new Event('change'));
});
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
