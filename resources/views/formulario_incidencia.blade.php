<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Incidencia - Incidex</title>
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
            <div class="sidebar-item active px-4 py-3 rounded-lg transition duration-200">
                <a href="#" class="flex items-center space-x-3 text-white">
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

            <div class="sidebar-item px-4 py-3 rounded-lg transition duration-200 hover:bg-surface-800">
                <a href="#" class="flex items-center space-x-3 text-surface-300 hover:text-white">
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
                    <h2 class="text-xl font-bold text-white">Registrar Nueva Incidencia</h2>
                    <p class="text-surface-400 text-sm">Completa el formulario para reportar una incidencia</p>
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
            <div class="max-w-4xl mx-auto">
                <!-- Alertas -->
                <div class="glass-effect rounded-xl p-4 mb-6 border border-surface-700">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-info-circle text-primary-400 text-lg"></i>
                        <div>
                            <p class="text-surface-200 font-medium">Información importante</p>
                            <p class="text-surface-400 text-sm">Todos los campos marcados con * son obligatorios</p>
                        </div>
                    </div>
                </div>

                <!-- Formulario de Incidencia -->
                <div class="glass-effect rounded-2xl p-8 border border-surface-700">
                    <form class="space-y-6" id="incidenciaForm">
                        <!-- Información Básica -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="titulo" class="block text-sm font-medium text-surface-200 mb-2">
                                    <i class="fas fa-heading text-primary-400 mr-2"></i>
                                    Título de la Incidencia *
                                </label>
                                <input id="titulo" name="titulo" type="text" required
                                       class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200"
                                       placeholder="Ej: Error en el servidor de base de datos">
                            </div>

                            <div>
                                <label for="categoria" class="block text-sm font-medium text-surface-200 mb-2">
                                    <i class="fas fa-tag text-primary-400 mr-2"></i>
                                    Categoría *
                                </label>
                                <select id="categoria" name="categoria" required
                                        class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                                    <option value="">Selecciona una categoría</option>
                                    <option value="hardware">Hardware</option>
                                    <option value="software">Software</option>
                                    <option value="red">Red</option>
                                    <option value="seguridad">Seguridad</option>
                                    <option value="usuario">Problema de Usuario</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="prioridad" class="block text-sm font-medium text-surface-200 mb-2">
                                    <i class="fas fa-exclamation-triangle text-primary-400 mr-2"></i>
                                    Prioridad *
                                </label>
                                <select id="prioridad" name="prioridad" required
                                        class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                                    <option value="">Selecciona prioridad</option>
                                    <option value="baja">Baja</option>
                                    <option value="media">Media</option>
                                    <option value="alta">Alta</option>
                                    <option value="critica">Crítica</option>
                                </select>
                            </div>

                            <div>
                                <label for="departamento" class="block text-sm font-medium text-surface-200 mb-2">
                                    <i class="fas fa-building text-primary-400 mr-2"></i>
                                    Departamento
                                </label>
                                <select id="departamento" name="departamento"
                                        class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                                    <option value="">Selecciona departamento</option>
                                    <option value="it">TI</option>
                                    <option value="ventas">Ventas</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="rrhh">Recursos Humanos</option>
                                </select>
                            </div>

                            <div>
                                <label for="fecha_limite" class="block text-sm font-medium text-surface-200 mb-2">
                                    <i class="fas fa-calendar-alt text-primary-400 mr-2"></i>
                                    Fecha Límite
                                </label>
                                <input id="fecha_limite" name="fecha_limite" type="date"
                                       class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl focus:outline-none transition duration-200">
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label for="descripcion" class="block text-sm font-medium text-surface-200 mb-2">
                                <i class="fas fa-align-left text-primary-400 mr-2"></i>
                                Descripción Detallada *
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="5" required
                                      class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200"
                                      placeholder="Describe detalladamente la incidencia, incluyendo pasos para reproducir el problema..."></textarea>
                        </div>

                        <!-- Archivos Adjuntos -->
                        <div>
                            <label class="block text-sm font-medium text-surface-200 mb-2">
                                <i class="fas fa-paperclip text-primary-400 mr-2"></i>
                                Archivos Adjuntos
                            </label>
                            <div class="border-2 border-dashed border-surface-600 rounded-xl p-6 text-center">
                                <i class="fas fa-cloud-upload-alt text-3xl text-surface-400 mb-3"></i>
                                <p class="text-surface-300 mb-2">Arrastra archivos aquí o haz clic para seleccionar</p>
                                <p class="text-surface-400 text-sm">Máximo 10MB por archivo (PNG, JPG, PDF, DOC)</p>
                                <input type="file" class="hidden" id="archivos" multiple>
                                <button type="button" onclick="document.getElementById('archivos').click()"
                                        class="mt-3 px-4 py-2 bg-surface-700 text-surface-300 rounded-lg hover:bg-surface-600 transition duration-200">
                                    Seleccionar Archivos
                                </button>
                            </div>
                            <div id="archivos-lista" class="mt-3 space-y-2 hidden">
                                <!-- Los archivos seleccionados aparecerán aquí -->
                            </div>
                        </div>

                        <!-- Información de Contacto -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contacto_nombre" class="block text-sm font-medium text-surface-200 mb-2">
                                    <i class="fas fa-user text-primary-400 mr-2"></i>
                                    Persona de Contacto
                                </label>
                                <input id="contacto_nombre" name="contacto_nombre" type="text"
                                       class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200"
                                       placeholder="Nombre del contacto">
                            </div>

                            <div>
                                <label for="contacto_telefono" class="block text-sm font-medium text-surface-200 mb-2">
                                    <i class="fas fa-phone text-primary-400 mr-2"></i>
                                    Teléfono de Contacto
                                </label>
                                <input id="contacto_telefono" name="contacto_telefono" type="tel"
                                       class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200"
                                       placeholder="+1 234 567 890">
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-surface-700">
                            <button type="submit"
                                    class="flex-1 py-3 px-6 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 neon-glow flex items-center justify-center space-x-2">
                                <i class="fas fa-paper-plane"></i>
                                <span>Registrar Incidencia</span>
                            </button>

                            <button type="button"
                                    class="flex-1 py-3 px-6 border border-surface-600 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center justify-center space-x-2">
                                <i class="fas fa-times"></i>
                                <span>Cancelar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Manejo de archivos adjuntos
    document.getElementById('archivos').addEventListener('change', function(e) {
        const archivosLista = document.getElementById('archivos-lista');
        archivosLista.innerHTML = '';

        if (this.files.length > 0) {
            archivosLista.classList.remove('hidden');

            Array.from(this.files).forEach((file, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between p-3 bg-surface-800/50 rounded-lg';
                div.innerHTML = `
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file text-primary-400"></i>
                            <span class="text-surface-200 text-sm">${file.name}</span>
                            <span class="text-surface-400 text-xs">(${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
                        </div>
                        <button type="button" class="text-surface-400 hover:text-red-400" onclick="removerArchivo(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                archivosLista.appendChild(div);
            });
        } else {
            archivosLista.classList.add('hidden');
        }
    });

    // Función para remover archivo
    window.removerArchivo = function(index) {
        const input = document.getElementById('archivos');
        const dt = new DataTransfer();
        const files = Array.from(input.files);

        files.splice(index, 1);
        files.forEach(file => dt.items.add(file));
        input.files = dt.files;

        // Disparar el evento change para actualizar la lista
        input.dispatchEvent(new Event('change'));
    };

    // Validación del formulario
    document.getElementById('incidenciaForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const titulo = document.getElementById('titulo').value;
        const categoria = document.getElementById('categoria').value;
        const prioridad = document.getElementById('prioridad').value;

        if (!titulo || !categoria || !prioridad) {
            alert('Por favor completa todos los campos obligatorios');
            return;
        }

        // Simular envío exitoso
        alert('✅ Incidencia registrada exitosamente!\n\nLa incidencia ha sido enviada al sistema y será asignada a un técnico pronto.');
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
</script>
</body>
</html>
