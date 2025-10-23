<footer class="glass-effect border-t border-surface-700 py-4 px-6 mt-auto">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
            <!-- Copyright -->
            <div class="flex items-center space-x-2">
                <i class="fas fa-copyright text-surface-400 text-sm"></i>
                <p class="text-surface-300 text-sm">
                    <span id="currentYear"></span> Incidex. Todos los derechos reservados.
                </p>
            </div>

            <!-- Enlaces rápidos -->
            <div class="flex space-x-4">
                <a href="#" class="text-surface-400 hover:text-primary-400 transition duration-200 text-xs">
                    Política de Privacidad
                </a>
                <a href="#" class="text-surface-400 hover:text-primary-400 transition duration-200 text-xs">
                    Términos de Servicio
                </a>
                <a href="#" class="text-surface-400 hover:text-primary-400 transition duration-200 text-xs">
                    Contacto
                </a>
            </div>
        </div>
    </div>
</footer>

<script>
    document.getElementById('currentYear').textContent = new Date().getFullYear();
</script>
