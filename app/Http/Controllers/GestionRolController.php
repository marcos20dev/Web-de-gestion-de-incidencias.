<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;

class GestionRolController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $query = Rol::query();

        if ($search) {
            $query->where('nombre', 'like', "%{$search}%");
        }

        $roles = $query->orderBy('nombre')->get();

        $estadisticas = [
            'total' => $roles->count(),
        ];

        return view('roles.index', compact('roles', 'estadisticas', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre',
        ]);

        try {
            DB::beginTransaction();

            $rol = Rol::create($validated);

            DB::commit();

            return redirect()->route('gestion-roles.index')
                ->with('success', 'Rol creado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Error al crear el rol: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, Rol $rol)
    {
        // No permitir editar roles del sistema
        if ($rol->isSystemDefault()) {
            return redirect()->route('gestion-roles.index')
                ->with('error', 'No se puede editar un rol del sistema.');
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:50|unique:roles,nombre,' . $rol->id_roles . ',id_roles',
        ]);

        try {
            DB::beginTransaction();

            $rol->update($validated);

            DB::commit();

            return redirect()->route('gestion-roles.index')
                ->with('success', 'Rol actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Error al actualizar el rol: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Rol $rol)
    {
        // No permitir eliminar roles del sistema
        if ($rol->isSystemDefault()) {
            return redirect()->route('gestion-roles.index')
                ->with('error', 'No se puede eliminar un rol del sistema.');
        }

        // Verificar si el rol tiene usuarios asignados
        if ($rol->usuarios && $rol->usuarios->count() > 0) {
            return redirect()->route('gestion-roles.index')
                ->with('error', 'No se puede eliminar el rol porque tiene usuarios asignados.');
        }

        try {
            DB::beginTransaction();

            $rol->delete();

            DB::commit();

            return redirect()->route('gestion-roles.index')
                ->with('success', 'Rol eliminado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('gestion-roles.index')
                ->with('error', 'Error al eliminar el rol: ' . $e->getMessage());
        }
    }
}
