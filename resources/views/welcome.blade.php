<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Incidex</title>
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
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'slide-in-left': 'slide-in-left 0.8s ease-out',
                        'slide-in-right': 'slide-in-right 0.8s ease-out',
                        'pulse-soft': 'pulse-soft 2s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        'slide-in-left': {
                            '0%': { transform: 'translateX(-30px)', opacity: 0 },
                            '100%': { transform: 'translateX(0)', opacity: 1 },
                        },
                        'slide-in-right': {
                            '0%': { transform: 'translateX(30px)', opacity: 0 },
                            '100%': { transform: 'translateX(0)', opacity: 1 },
                        },
                        'pulse-soft': {
                            '0%, 100%': { opacity: 1 },
                            '50%': { opacity: 0.8 },
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
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .neon-glow {
            box-shadow: 0 0 20px rgba(74, 222, 128, 0.15);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 2px rgba(34, 197, 94, 0.3);
            border-color: #22c55e;
        }

        .gradient-text {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .container-gradient {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
        }

        .hidden-message {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .hidden-message.show {
            max-height: 200px;
            opacity: 1;
        }
    </style>
</head>
<body class="flex items-center justify-center p-4 min-h-screen">
<!-- Efectos de fondo -->
<div class="fixed inset-0 overflow-hidden">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-float"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-400 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-primary-300 rounded-full mix-blend-multiply filter blur-3xl opacity-5 animate-float" style="animation-delay: 4s;"></div>
</div>

<!-- Contenedor principal -->
<div class="w-full max-w-7xl mx-auto">
    <div class="glass-effect rounded-3xl overflow-hidden shadow-2xl border border-surface-700">
        <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[700px]">

            <!-- Lado izquierdo - Branding -->
            <div class="container-gradient p-12 flex flex-col justify-between animate-slide-in-left">
                <div>
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center neon-glow">
                            <i class="fas fa-sign-in-alt text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-white">Incidex</h1>
                            <p class="text-surface-400 text-sm">Sistema de Gestión</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h2 class="text-4xl font-bold text-white leading-tight">
                            Bienvenido a
                            <span class="gradient-text">Incidex</span>
                        </h2>

                        <p class="text-surface-300 text-lg leading-relaxed">
                            Accede a tu cuenta para gestionar incidencias de manera profesional con nuestro sistema multi-rol avanzado.
                        </p>
                    </div>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-primary-500/20 flex items-center justify-center">
                                <i class="fas fa-user-shield text-primary-400 text-sm"></i>
                            </div>
                            <span class="text-surface-300">Sistema de roles y permisos</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-primary-500/20 flex items-center justify-center">
                                <i class="fas fa-chart-bar text-primary-400 text-sm"></i>
                            </div>
                            <span class="text-surface-300">Dashboard personalizado por rol</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-primary-500/20 flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-primary-400 text-sm"></i>
                            </div>
                            <span class="text-surface-300">Acceso multi-dispositivo</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-primary-500/20 flex items-center justify-center">
                                <i class="fas fa-history text-primary-400 text-sm"></i>
                            </div>
                            <span class="text-surface-300">Historial completo de incidencias</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <div class="bg-surface-800/50 rounded-xl p-4 border border-surface-700">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-info-circle text-primary-400 text-lg"></i>
                            <div>
                                <p class="text-surface-200 text-sm font-medium">¿Problemas para acceder?</p>
                                <p class="text-surface-400 text-xs">Contacta con soporte técnico si necesitas ayuda</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lado derecho - Formulario de Login -->
            <div class="bg-surface-900 p-12 flex flex-col justify-center animate-slide-in-right">
                <div class="max-w-md w-full mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-white">Iniciar Sesión</h2>
                        <p class="text-surface-400 mt-2">Ingresa tus credenciales para acceder</p>
                    </div>

                    <form class="space-y-6" id="loginForm">
                        <div>
                            <label for="email" class="block text-sm font-medium text-surface-200 mb-2">
                                <i class="fas fa-envelope text-primary-400 mr-2"></i>
                                Correo electrónico
                            </label>
                            <input id="email" name="email" type="email" required
                                   class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200"
                                   placeholder="tu@empresa.com">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-surface-200 mb-2">
                                <i class="fas fa-lock text-primary-400 mr-2"></i>
                                Contraseña
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" required
                                       class="input-focus bg-surface-800 text-white w-full px-4 py-3 border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none transition duration-200 pr-12"
                                       placeholder="••••••••">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                                    <i class="fas fa-eye text-surface-400 hover:text-surface-300 transition duration-200"></i>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember_me" type="checkbox"
                                       class="h-4 w-4 text-primary-500 focus:ring-primary-400 border-surface-600 rounded bg-surface-800">
                                <label for="remember_me" class="ml-2 block text-sm text-surface-300">
                                    Recordarme
                                </label>
                            </div>
                            <a href="#" class="text-sm text-primary-400 hover:text-primary-300 transition duration-200">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>

                        <!-- Información de estado de cuenta -->
                        <div class="bg-surface-800/50 rounded-xl p-4 border border-surface-700">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-info-circle text-primary-400 mt-1"></i>
                                <div class="flex-1">
                                    <p class="text-surface-200 text-sm font-medium">Estado de tu cuenta</p>
                                    <p class="text-surface-400 text-xs mt-1">
                                        Si tu cuenta está <span class="text-primary-400">pendiente de aprobación</span>,
                                        no podrás acceder hasta que sea activada.
                                    </p>
                                    <button type="button" id="showStatusInfo" class="text-primary-400 hover:text-primary-300 text-xs mt-2 flex items-center">
                                        <i class="fas fa-question-circle mr-1"></i>
                                        Verificar estado de cuenta
                                    </button>
                                    <div id="statusInfo" class="hidden-message mt-2">
                                        <div class="bg-surface-700/30 rounded-lg p-3">
                                            <p class="text-surface-300 text-xs">
                                                <strong>Cuenta activa:</strong> Acceso inmediato al sistema<br>
                                                <strong>Pendiente de aprobación:</strong> Espera notificación por correo<br>
                                                <strong>Cuenta suspendida:</strong> Contacta con administración
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full py-3 px-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 neon-glow flex items-center justify-center space-x-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Iniciar Sesión</span>
                        </button>

                        <div class="relative mt-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-surface-700"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-3 bg-surface-900 text-surface-400">¿No tienes cuenta?</span>
                            </div>
                        </div>

                        <a href="#"
                           class="w-full py-3 px-4 border border-surface-700 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Crear Cuenta</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle para mostrar/ocultar contraseña
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.relative').querySelector('input');
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });

    // Mostrar información de estado de cuenta
    document.getElementById('showStatusInfo').addEventListener('click', function() {
        const info = document.getElementById('statusInfo');
        info.classList.toggle('show');
    });

    // Validación del formulario
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const rememberMe = document.getElementById('remember_me').checked;

        // Simular inicio de sesión exitoso
        alert(`✅ Inicio de sesión exitoso!\n\nEmail: ${email}\nRecordar sesión: ${rememberMe ? 'Sí' : 'No'}\n\nRedirigiendo al dashboard...`);
    });
</script>
</body>
</html>
