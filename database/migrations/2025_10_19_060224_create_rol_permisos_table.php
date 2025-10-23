<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('rol_permisos', function (Blueprint $table) {
            $table->id('id_rol_permisos');
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('id_permisos');
            $table->boolean('estado')->default(true);
            $table->timestamps();
            $table->foreign('rol_id')->references('id_roles')->on('roles')->onDelete('cascade');
            $table->foreign('id_permisos')->references('id_permisos')->on('permisos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rol_permisos');
    }
};
