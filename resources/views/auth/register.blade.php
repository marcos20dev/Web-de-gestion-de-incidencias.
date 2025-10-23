@extends('layouts.app')

@section('title', 'Registro - Incidex')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-surface-900 via-surface-800 to-surface-900">
        <!-- Efectos de fondo -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-500 rounded-full mix-blend-multiply blur-3xl opacity-10 animate-[float_6s_ease-in-out_infinite]"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-400 rounded-full mix-blend-multiply blur-3xl opacity-10 animate-[float_6s_ease-in-out_infinite] animation-delay-[2s]"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-primary-300 rounded-full mix-blend-multiply blur-3xl opacity-5 animate-[float_6s_ease-in-out_infinite] animation-delay-[4s]"></div>
        </div>

        <!-- Contenedor principal -->
        <div class="w-full max-w-7xl mx-auto">
            <div class="bg-white/5 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl border border-surface-700 shadow-[0_0_20px_rgba(74,222,128,0.15)]">
                <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[700px]">

                    <!-- Lado izquierdo - Branding -->
                    <div class="bg-gradient-to-br from-surface-800/90 to-surface-900/95 p-12 flex flex-col justify-between animate-[slide-in-left_0.8s_ease-out]">
                        <div>
                            <div class="flex items-center space-x-4 mb-8">
                                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-[0_0_20px_rgba(74,222,128,0.15)]">
                                    <i class="fas fa-user-plus text-white text-2xl"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-white">Incidex</h1>
                                    <p class="text-surface-400 text-sm">Sistema de Gestión</p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h2 class="text-4xl font-bold text-white leading-tight">
                                    Únete a Nuestra
                                    <span class="bg-gradient-to-r from-primary-400 to-primary-500 bg-clip-text text-transparent">Plataforma</span>
                                    de Gestión
                                </h2>

                                <p class="text-surface-300 text-lg leading-relaxed">
                                    Crea tu cuenta y comienza a gestionar incidencias de manera profesional con nuestro sistema multi-rol avanzado.
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
                                        <i class="fas fa-clock text-primary-400 text-sm"></i>
                                    </div>
                                    <span class="text-surface-300">Verificación de cuenta en 24h</span>
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
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="bg-surface-800/50 rounded-xl p-4 border border-surface-700">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-info-circle text-primary-400 text-lg"></i>
                                    <div>
                                        <p class="text-surface-200 text-sm font-medium">Proceso de verificación</p>
                                        <p class="text-surface-400 text-xs">Tu cuenta será activada después de la revisión administrativa</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lado derecho - Formulario de Registro -->
                    <div class="bg-surface-900 p-12 flex flex-col justify-center animate-[slide-in-right_0.8s_ease-out]">
                        <div class="max-w-md w-full mx-auto">
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-white">Crear Cuenta</h2>
                                <p class="text-surface-400 mt-2">Completa tus datos para registrarte</p>
                            </div>

                            <form class="space-y-6" id="registerForm" method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Información Personal -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="nombre" class="block text-sm font-medium text-surface-200 mb-2">
                                            <i class="fas fa-user text-primary-400 mr-2"></i>
                                            Nombre
                                        </label>
                                        <input id="nombre" name="nombre" type="text" required
                                               class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                                               placeholder="Tu nombre"
                                               value="{{ old('nombre') }}">
                                        @error('nombre')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="apellido_paterno" class="block text-sm font-medium text-surface-200 mb-2">
                                            <i class="fas fa-user text-primary-400 mr-2"></i>
                                            Apellido Paterno
                                        </label>
                                        <input id="apellido_paterno" name="apellido_paterno" type="text" required
                                               class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                                               placeholder="Apellido paterno"
                                               value="{{ old('apellido_paterno') }}">
                                        @error('apellido_paterno')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="apellido_materno" class="block text-sm font-medium text-surface-200 mb-2">
                                            <i class="fas fa-user text-primary-400 mr-2"></i>
                                            Apellido Materno
                                        </label>
                                        <input id="apellido_materno" name="apellido_materno" type="text" required
                                               class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                                               placeholder="Apellido materno"
                                               value="{{ old('apellido_materno') }}">
                                        @error('apellido_materno')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-surface-200 mb-2">
                                        <i class="fas fa-envelope text-primary-400 mr-2"></i>
                                        Correo electrónico
                                    </label>
                                    <input id="email" name="email" type="email" required
                                           class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200"
                                           placeholder="tu@empresa.com"
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-surface-200 mb-2">
                                            <i class="fas fa-lock text-primary-400 mr-2"></i>
                                            Contraseña
                                        </label>
                                        <div class="relative">
                                            <input id="password" name="password" type="password" required
                                                   class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200 pr-12"
                                                   placeholder="••••••••">
                                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                                                <i class="fas fa-eye text-surface-400 hover:text-surface-300 transition duration-200"></i>
                                            </button>
                                        </div>
                                        <div class="mt-2 flex space-x-1">
                                            <div class="password-strength w-1/4 bg-surface-600 rounded h-1 transition-all duration-300"></div>
                                            <div class="password-strength w-1/4 bg-surface-600 rounded h-1 transition-all duration-300"></div>
                                            <div class="password-strength w-1/4 bg-surface-600 rounded h-1 transition-all duration-300"></div>
                                            <div class="password-strength w-1/4 bg-surface-600 rounded h-1 transition-all duration-300"></div>
                                        </div>
                                        @error('password')
                                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-surface-200 mb-2">
                                            <i class="fas fa-lock text-primary-400 mr-2"></i>
                                            Confirmar contraseña
                                        </label>
                                        <div class="relative">
                                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                                   class="w-full px-4 py-3 bg-surface-800 text-white border border-surface-600 rounded-xl placeholder-surface-500 focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/30 transition duration-200 pr-12"
                                                   placeholder="••••••••">
                                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password">
                                                <i class="fas fa-eye text-surface-400 hover:text-surface-300 transition duration-200"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selección de Rol -->
                                <div>
                                    <label class="block text-sm font-medium text-surface-200 mb-3">
                                        <i class="fas fa-user-tag text-primary-400 mr-2"></i>
                                        Selecciona tu rol
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div class="role-option border-2 border-surface-600 rounded-xl p-3 text-center cursor-pointer transition-all duration-300 hover:translate-y-[-2px] hover:border-primary-400/30"
                                             data-role="usuario">
                                            <i class="fas fa-user text-2xl text-surface-400 mb-2"></i>
                                            <h3 class="font-medium text-surface-200 text-sm">Usuario</h3>
                                            <p class="text-xs text-surface-400 mt-1">Reportar incidencias</p>
                                        </div>

                                        <div class="role-option border-2 border-surface-600 rounded-xl p-3 text-center cursor-pointer transition-all duration-300 hover:translate-y-[-2px] hover:border-primary-400/30"
                                             data-role="tecnico">
                                            <i class="fas fa-tools text-2xl text-surface-400 mb-2"></i>
                                            <h3 class="font-medium text-surface-200 text-sm">Técnico</h3>
                                            <p class="text-xs text-surface-400 mt-1">Resolver incidencias</p>
                                        </div>

                                        <div class="role-option border-2 border-surface-600 rounded-xl p-3 text-center cursor-pointer transition-all duration-300 hover:translate-y-[-2px] hover:border-primary-400/30"
                                             data-role="admin">
                                            <i class="fas fa-cog text-2xl text-surface-400 mb-2"></i>
                                            <h3 class="font-medium text-surface-200 text-sm">Administrador</h3>
                                            <p class="text-xs text-surface-400 mt-1">Gestionar sistema</p>
                                        </div>
                                    </div>
                                    <input type="hidden" id="selected_role" name="rol" value="{{ old('rol', 'usuario') }}">
                                    @error('rol')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Información de aprobación -->
                                <div class="bg-surface-800/50 rounded-xl p-4 border border-surface-700">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas fa-clock text-primary-400 mt-1"></i>
                                        <div class="flex-1">
                                            <p class="text-surface-200 text-sm font-medium">Proceso de aprobación</p>
                                            <p class="text-surface-400 text-xs mt-1">
                                                Después del registro, tu cuenta estará <span class="text-primary-400">pendiente de aprobación</span>.
                                                Recibirás un correo cuando sea activada.
                                            </p>
                                            <button type="button" id="showApprovalInfo" class="text-primary-400 hover:text-primary-300 text-xs mt-2 flex items-center">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Más información sobre el proceso
                                            </button>
                                            <div id="approvalInfo" class="max-h-0 opacity-0 overflow-hidden transition-all duration-400 mt-2">
                                                <div class="bg-surface-700/30 rounded-lg p-3">
                                                    <p class="text-surface-300 text-xs">
                                                        <strong>Tiempo estimado:</strong> 1-24 horas<br>
                                                        <strong>Notificación:</strong> Vía correo electrónico<br>
                                                        <strong>Estado:</strong> Podrás ver el estado en la página de login
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <input id="terms" name="terms" type="checkbox" required
                                           class="h-4 w-4 text-primary-500 focus:ring-primary-400 border-surface-600 rounded bg-surface-800">
                                    <label for="terms" class="ml-2 block text-sm text-surface-300">
                                        Acepto los <a href="#" class="text-primary-400 hover:text-primary-300">términos</a> y
                                        <a href="#" class="text-primary-400 hover:text-primary-300">política de privacidad</a>
                                    </label>
                                </div>
                                @error('terms')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <button type="submit"
                                        class="w-full py-3 px-4 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white font-medium rounded-xl transition duration-200 shadow-[0_0_20px_rgba(74,222,128,0.15)] flex items-center justify-center space-x-2">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Crear Cuenta</span>
                                </button>

                                <div class="relative mt-6">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-surface-700"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-3 bg-surface-900 text-surface-400">¿Ya tienes cuenta?</span>
                                    </div>
                                </div>

                                <a href="{{ route('login') }}"
                                   class="w-full py-3 px-4 border border-surface-700 text-surface-300 font-medium rounded-xl hover:bg-surface-800 transition duration-200 flex items-center justify-center space-x-2">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Iniciar Sesión</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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

        // Selección de rol
        document.querySelectorAll('.role-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.role-option').forEach(opt => {
                    opt.classList.remove('border-primary-500', 'bg-primary-500/5', 'shadow-[0_0_20px_rgba(74,222,128,0.15)]');
                });

                this.classList.add('border-primary-500', 'bg-primary-500/5', 'shadow-[0_0_20px_rgba(74,222,128,0.15)]');
                document.getElementById('selected_role').value = this.dataset.role;
            });
        });

        // Mostrar información de aprobación
        document.getElementById('showApprovalInfo').addEventListener('click', function() {
            const info = document.getElementById('approvalInfo');
            const isHidden = info.classList.contains('max-h-0');

            if (isHidden) {
                info.classList.remove('max-h-0', 'opacity-0');
                info.classList.add('max-h-48', 'opacity-100');
            } else {
                info.classList.remove('max-h-48', 'opacity-100');
                info.classList.add('max-h-0', 'opacity-0');
            }
        });

        // Simular fortaleza de contraseña
        document.getElementById('password').addEventListener('input', function() {
            const strengthBars = document.querySelectorAll('.password-strength');
            const password = this.value;
            let strength = 0;

            if (password.length > 0) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password) && /[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password) && /[^A-Za-z0-9]/.test(password)) strength++;

            strengthBars.forEach((bar, index) => {
                bar.className = 'password-strength w-1/4 rounded h-1 transition-all duration-300';
                if (index < strength) {
                    bar.classList.add('bg-primary-500');
                } else {
                    bar.classList.add('bg-surface-600');
                }
            });
        });

        // Seleccionar rol por defecto basado en valor antiguo o por defecto
        document.addEventListener('DOMContentLoaded', function() {
            const selectedRole = document.getElementById('selected_role').value;
            const roleOption = document.querySelector(`[data-role="${selectedRole}"]`);
            if (roleOption) {
                roleOption.click();
            } else {
                document.querySelector('[data-role="usuario"]').click();
            }
        });

        // Mostrar errores de validación si existen
        @if($errors->any())
        const firstError = document.querySelector('.text-red-400');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        @endif
    </script>
@endsection
