<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Permiso;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.sidebar', function ($view) {
            $user = Auth::user();

            // Traer permisos activos del rol del usuario
            $permisos = $user?->rolData?->permisos()->wherePivot('estado', true)->get() ?? collect();

            // Mapear slugs a rutas
            $permisos_rutas = [
                'dashboard_home' => route('dashboard'),
                'mis_incidencias' => route('incidencias.mis'),
                'crear_incidencia' => route('incidencias.create'),
                'reportes_incidencias' => '#',
                'perfil_configuracion' => '#',
                'incidencias_asignadas' => route('incidencias.asignadas'),
                'solicitudes_enviadas' => route('solicitudes.historial'),
                'todas_incidencias' => route('incidencias.general'),
                'asignar_incidencias' => '#',
                'solicitudes_tecnicos' => '#',
                'gestionar_usuarios' => route('gestion-usuarios.index'),
                'gestionar_roles' => route('gestion-roles.index'),
                'categorias' => route('categorias.index'),
                'auditoria_registro' => '#',
        ];


            $view->with(compact('permisos', 'permisos_rutas'));
        });
    }
}
