<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('solicitudes_aprobacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incidencia_id')->constrained('incidencias', 'id_incidencias');
            $table->foreignId('tecnico_id')->constrained('users');
            $table->foreignId('supervisor_id')->nullable()->constrained('users');
            $table->string('tipo'); // aprobacion, recursos, asistencia, otros
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('justificacion');
            $table->text('recursos_solicitados')->nullable(); // materiales, herramientas, etc.
            $table->decimal('costo_estimado', 10, 2)->nullable();
            $table->string('estado')->default('pendiente'); // pendiente, aprobada, rechazada, cancelada
            $table->text('comentarios_supervisor')->nullable();
            $table->timestamp('fecha_aprobacion')->nullable();
            $table->timestamp('fecha_rechazo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solicitudes_aprobacion');
    }
};
