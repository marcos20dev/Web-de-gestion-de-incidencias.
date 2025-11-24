<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('permisos', function (Blueprint $table) {
            // Campo slug único para asociar permisos con rutas
            $table->string('slug')->unique()->after('nombre')->nullable();

            // Opcional: icono si quieres mostrarlo en el sidebar
            $table->string('icono')->nullable()->after('slug');
        });
    }

    public function down(): void
    {
        Schema::table('permisos', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('icono');
        });
    }
};
