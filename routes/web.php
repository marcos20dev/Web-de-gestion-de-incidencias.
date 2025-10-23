<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GestionRolController;
use App\Http\Controllers\GestionUsuarioController;
use App\Http\Controllers\IncidenciaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registro
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);


});

// Ruta de logout (protegida)
Route::middleware('auth')->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =====================================================
    // 📦 MÓDULO DE INCIDENCIAS (sin middleware de permisos)
    // =====================================================
    Route::prefix('incidencias')->group(function () {
        // Registrar incidencia
        Route::get('/crear', [IncidenciaController::class, 'create'])->name('incidencias.create');
        Route::post('/', [IncidenciaController::class, 'store'])->name('incidencias.store');

        // Mis incidencias
        Route::get('/mis-incidencias', [IncidenciaController::class, 'misIncidencias'])->name('incidencias.mis');

        // Incidencias asignadas
        Route::get('/asignadas', [IncidenciaController::class, 'asignadas'])->name('incidencias.asignadas');

        // Todas las incidencias
        Route::get('/todas', [IncidenciaController::class, 'todas'])->name('incidencias.todas');

        // Rutas individuales
        Route::get('/{incidencia}', [IncidenciaController::class, 'show'])->name('incidencias.show');
        Route::get('/{incidencia}/editar', [IncidenciaController::class, 'edit'])->name('incidencias.edit');
        Route::put('/{incidencia}', [IncidenciaController::class, 'update'])->name('incidencias.update');
    });


    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index');
        Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store');
        Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
        Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

        // Ruta específica para toggle del estado
        Route::put('/{categoria}/estado', [CategoriaController::class, 'toggleEstado'])->name('categorias.toggle');

        // API para sugerencias
        Route::get('/api/listar', [CategoriaController::class, 'getCategorias'])->name('categorias.api');
    });



// routes/web.php
    Route::prefix('gestion-usuarios')->group(function () {
        Route::get('/', [GestionUsuarioController::class, 'index'])->name('gestion-usuarios.index');
        Route::post('/', [GestionUsuarioController::class, 'store'])->name('gestion-usuarios.store');
        Route::post('/{id}/estado', [GestionUsuarioController::class, 'updateEstado'])->name('gestion-usuarios.estado');
        Route::delete('/{id}', [GestionUsuarioController::class, 'destroy'])->name('gestion-usuarios.destroy');
    });

    // routes/web.php
    Route::prefix('gestion-roles')->group(function () {
        Route::get('/', [GestionRolController::class, 'index'])->name('gestion-roles.index');
        Route::post('/', [GestionRolController::class, 'store'])->name('gestion-roles.store');
        Route::put('/{rol}', [GestionRolController::class, 'update'])->name('gestion-roles.update');
        Route::delete('/{rol}', [GestionRolController::class, 'destroy'])->name('gestion-roles.destroy');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
