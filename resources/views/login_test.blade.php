<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col">

        <!-- NAVBAR -->
        <nav class="bg-blue-600/80 backdrop-blur-md shadow-md">
            <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold tracking-wide">Incidex</h1>
                <button class="px-4 py-2 bg-white/10 rounded-lg hover:bg-white/20 transition">
                    Iniciar sesión
                </button>
            </div>
        </nav>

        <!-- MAIN -->
        <main class="flex-1 flex flex-col items-center justify-center text-center px-4">
            <div class="relative">
                <!-- Circles background -->
                <div class="absolute inset-0 -z-10">
                    <div class="absolute top-10 left-20 w-48 h-48 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-bounce-slow"></div>
                    <div class="absolute bottom-10 right-20 w-56 h-56 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
                </div>

                <h1 class="text-5xl md:text-6xl font-extrabold mb-4">
                    Bienvenido a <span class="text-blue-400">Incidex</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-8">
                    Tu plataforma moderna para la gestión inteligente de incidencias y reportes en tiempo real.
                </p>

                <div class="flex flex-wrap gap-4 justify-center">
                    <button
                        class="px-6 py-3 bg-blue-500 hover:bg-blue-600 rounded-xl font-semibold text-white transition transform hover:scale-105"
                    >
                        Empezar ahora
                    </button>
                    <button
                        class="px-6 py-3 border border-gray-600 rounded-xl font-semibold text-gray-300 hover:bg-white/10 transition transform hover:scale-105"
                    >
                        Saber más
                    </button>
                </div>
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="py-6 text-center text-gray-500 text-sm border-t border-gray-700">
            © 2025 Incidex — Sistema de gestión de incidencias
        </footer>
    </div>
</template>

<script setup>
    // No script por ahora, ya que esta es una página estática de bienvenida.
</script>
