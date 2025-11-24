<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GestionRolController;
use App\Http\Controllers\GestionUsuarioController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\SolicitudController;

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


        Route::get('/todas', [IncidenciaController::class, 'general'])->name('incidencias.general');
    });




    Route::prefix('solicitudes')->middleware('auth')->group(function () {
        // 🟢 Historial (debe ir antes del {solicitud})
        Route::get('/historial', [SolicitudController::class, 'historial'])
            ->name('solicitudes.historial');

        // 🟢 Crear solicitud
        Route::get('/crear/{incidencia}', [SolicitudController::class, 'create'])
            ->name('solicitudes.create');

        Route::post('/store', [SolicitudController::class, 'store'])
            ->name('solicitudes.store');

        Route::get('/{solicitud}/cancelar', [SolicitudController::class, 'cancelar'])
            ->name('solicitudes.cancelar');

        // 🟢 Mis solicitudes
        Route::get('/mis-solicitudes', [SolicitudController::class, 'misSolicitudes'])
            ->name('solicitudes.mis');

        // 🟢 Aprobar/Rechazar
        Route::post('/{solicitud}/aprobar', [SolicitudController::class, 'aprobar'])
            ->name('solicitudes.aprobar');

        Route::post('/{solicitud}/rechazar', [SolicitudController::class, 'rechazar'])
            ->name('solicitudes.rechazar');

        // 🟢 Mostrar solicitud individual (debe ir al final)
        Route::get('/{solicitud}', [SolicitudController::class, 'show'])
            ->name('solicitudes.show');
    });



    Route::get('/incidencias/asignadas', [IncidenciaController::class, 'asignadas'])
        ->name('incidencias.asignadas');
    // Ruta para la vista de detalle de técnicos
    Route::get('/incidencias/asignadas/{id}', [IncidenciaController::class, 'showAsignada'])
        ->name('incidencias.asignadas.show');

    // Ruta para actualizar la solución/comentarios
    Route::post('/incidencias/asignadas/{id}/actualizar', [IncidenciaController::class, 'updateAsignada'])
        ->name('incidencias.asignadas.update');

    // Ruta para cambiar estado (iniciar/resolver)
    Route::post('/incidencias/{id}/cambiar-estado', [IncidenciaController::class, 'cambiarEstado'])
        ->name('incidencias.cambiar-estado');


    // Ruta para que usuarios vean el detalle de sus incidencias (solo lectura)
    Route::get('/mis-incidencias/{id}', [IncidenciaController::class, 'showUsuario'])
        ->name('incidencias.mis.show')
        ->middleware('auth');



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

    Route::put('/incidencias/{incidencia}/asignar', [IncidenciaController::class, 'asignarTecnico'])->name('incidencias.asignar');





    // routes/web.php

    Route::prefix('gestion-usuarios')->group(function () {
        Route::get('/', [GestionUsuarioController::class, 'index'])->name('gestion-usuarios.index');
        Route::post('/', [GestionUsuarioController::class, 'store'])->name('gestion-usuarios.store');
        Route::post('/{id}/aprobar-tecnico', [GestionUsuarioController::class, 'aprobarTecnico'])->name('gestion-usuarios.aprobar-tecnico');
        Route::post('/{id}/estado-tecnico', [GestionUsuarioController::class, 'cambiarEstadoTecnico'])->name('gestion-usuarios.estado-tecnico');
        Route::post('/{id}/estado', [GestionUsuarioController::class, 'updateEstado'])->name('gestion-usuarios.estado');
        Route::delete('/{id}', [GestionUsuarioController::class, 'destroy'])->name('gestion-usuarios.destroy');
    });


    // routes/web.php
    Route::prefix('gestion-roles')->group(function () {
        Route::get('/', [GestionRolController::class, 'index'])->name('gestion-roles.index');
        Route::post('/', [GestionRolController::class, 'store'])->name('gestion-roles.store');
        Route::put('/{rol}', [GestionRolController::class, 'update'])->name('gestion-roles.update');
        Route::delete('/{rol}', [GestionRolController::class, 'destroy'])->name('gestion-roles.destroy');

        Route::get('/gestion-roles/{rol}', [GestionRolController::class, 'show'])->name('gestion-roles.show');
        Route::get('/gestion-roles', [GestionRolController::class, 'index'])->name('gestion-roles.index');
        Route::post('/gestion-roles/{rol}/permisos', [GestionRolController::class, 'updatePermisos'])->name('gestion-roles.update-permisos');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
