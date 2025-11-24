<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            // Usuario
            ['nombre' => 'Dashboard', 'slug' => 'dashboard_home', 'icono' => 'fas fa-home'],
            ['nombre' => 'Mis Incidencias', 'slug' => 'mis_incidencias', 'icono' => 'fas fa-list'],
            ['nombre' => 'Crear Incidencia', 'slug' => 'crear_incidencia', 'icono' => 'fas fa-plus-circle'],
            ['nombre' => 'Reportes', 'slug' => 'reportes_incidencias', 'icono' => 'fas fa-chart-bar'],
            ['nombre' => 'Perfil / Configuración', 'slug' => 'perfil_configuracion', 'icono' => 'fas fa-user-cog'],

            // Técnico
            ['nombre' => 'Incidencias Asignadas', 'slug' => 'incidencias_asignadas', 'icono' => 'fas fa-tasks'],
            ['nombre' => 'Solicitudes Enviadas', 'slug' => 'solicitudes_enviadas', 'icono' => 'fas fa-paper-plane'],
            ['nombre' => 'Historial de Incidencias', 'slug' => 'historial_incidencias', 'icono' => 'fas fa-history'],

            // Administrador
            ['nombre' => 'Todas las Incidencias', 'slug' => 'todas_incidencias', 'icono' => 'fas fa-folder-open'],
            ['nombre' => 'Solicitudes de Técnicos', 'slug' => 'solicitudes_tecnicos', 'icono' => 'fas fa-users-cog'],
            ['nombre' => 'Gestionar Usuarios', 'slug' => 'gestionar_usuarios', 'icono' => 'fas fa-users'],
            ['nombre' => 'Gestionar Roles', 'slug' => 'gestionar_roles', 'icono' => 'fas fa-user-shield'],
            ['nombre' => 'Categorías', 'slug' => 'categorias', 'icono' => 'fas fa-tags'],
        ];

        foreach ($permisos as $permiso) {
            DB::table('permisos')->insert([
                'nombre' => $permiso['nombre'],
                'modulo' => 'Gestión de Incidencias',
                'slug' => $permiso['slug'],
                'icono' => $permiso['icono'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
