<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id('id_incidencias');
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('prioridad', ['baja', 'media', 'alta', 'critica'])->default('media');
            $table->enum('estado', ['pendiente', 'asignada', 'en_proceso', 'resuelta', 'cerrada'])->default('pendiente');
            $table->string('categoria');
            $table->string('ubicacion')->nullable();

            // Relaciones
            $table->unsignedBigInteger('usuario_id'); // Usuario que reporta
            $table->unsignedBigInteger('tecnico_id')->nullable(); // Técnico asignado
            $table->unsignedBigInteger('categoria_id')->nullable(); // Categoría (si la normalizas después)

            $table->timestamp('fecha_limite')->nullable();
            $table->timestamp('fecha_asignacion')->nullable();
            $table->timestamp('fecha_resolucion')->nullable();

            $table->text('solucion')->nullable();
            $table->text('comentarios')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tecnico_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
