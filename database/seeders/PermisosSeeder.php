<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    public function run(): void
    {
        $permisos = [
            'Dashboard',
            'Registrar Incidencia',
            'Mis Incidencias',
            'Incidencias Asignadas',
            'Resolver Incidencias',
            'Todas las Incidencias',
            'Usuarios',
            'Roles',
            'Reportes'
        ];

        foreach ($permisos as $nombre) {
            DB::table('permisos')->insert([
                'nombre' => $nombre,
                'modulo' => 'Gestión de Incidencias',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

