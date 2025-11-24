<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nombre' => 'Usuario'],
            ['nombre' => 'Técnico'],
            ['nombre' => 'Administrador'],
        ];

        foreach ($roles as $rol) {
            DB::table('roles')->insert([
                'nombre' => $rol['nombre'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
