<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;


class GestionUsuarioController extends Controller
{
    public function index(Request $request)
    {
        // IDs de roles según tu tabla roles
        $rolIds = [
            'usuario' => 1,
            'tecnico' => 2,
            'admin' => 3,
        ];

        // Obtener parámetros de filtro
        $search = $request->get('search');
        $estado = $request->get('estado');
        $rol = $request->get('rol');
        $tab = $request->get('tab', 'todos');

        // Consulta base
        $query = User::query();

        // Aplicar búsqueda
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('apellido_paterno', 'like', "%{$search}%")
                    ->orWhere('apellido_materno', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Aplicar filtro por estado
        if ($estado && $estado !== 'todos') {
            $query->where('estado', $estado);
        }

        // Aplicar filtro por rol
        if ($rol && $rol !== 'todos') {
            $query->where('rol_id', $rolIds[$rol]);
        }

        // Aplicar filtro por tab
        switch ($tab) {
            case 'usuarios':
                $query->where('rol_id', $rolIds['usuario']);
                break;
            case 'tecnicos':
                $query->where('rol_id', $rolIds['tecnico']);
                break;
            case 'supervisores':
                $query->where('rol_id', $rolIds['admin']);
                break;
            case 'pendientes':
                $query->where('estado', 'pendiente');
                break;
            case 'suspendidos':
                $query->where('estado', 'suspendido');
                break;
            case 'activos':
                $query->where('estado', 'activo');
                break;
        }

        // Obtener usuarios paginados
        $usuarios = $query->orderBy('created_at', 'desc')->paginate(10);

        // Estadísticas
        $totalUsuarios = User::count();
        $usuariosActivos = User::where('estado', 'activo')->count();
        $usuariosPendientes = User::where('estado', 'pendiente')->count();
        $usuariosSuspendidos = User::where('estado', 'suspendido')->count();

        // Conteos por rol
        $countUsuarios = User::where('rol_id', $rolIds['usuario'])->count();
        $countTecnicos = User::where('rol_id', $rolIds['tecnico'])->count();
        $countAdmins = User::where('rol_id', $rolIds['admin'])->count();

        return view('usuarios.index', compact(
            'usuarios',
            'totalUsuarios',
            'usuariosActivos',
            'usuariosPendientes',
            'usuariosSuspendidos',
            'countUsuarios',
            'countTecnicos',
            'countAdmins',
            'search',
            'estado',
            'rol',
            'tab'
        ));
    }


    // Agrega este método a tu GestionUsuarioController
   public function aprobarTecnico($id)
{
    try {
        Log::info("Intentando aprobar técnico con ID: {$id}");

        $user = User::findOrFail($id);
        Log::info("Usuario encontrado", ['id' => $user->id, 'rol_id' => $user->rol_id, 'estado' => $user->estado]);

        // Verificar que el usuario sea técnico
        if ($user->rol_id != 2) {
            Log::warning("Intento de aprobar usuario que no es técnico", ['id' => $user->id, 'rol_id' => $user->rol_id]);
            return redirect()->back()
                ->with('error', 'Solo se pueden aprobar usuarios con rol de técnico.');
        }

        // Crear o actualizar estado del técnico
        \App\Models\EstadoTecnico::updateOrCreate(
            ['user_id' => $user->id],
            [
                'estado' => 'disponible',
                'observacion' => 'Técnico aprobado por administrador'
            ]
        );
        Log::info("Estado del técnico actualizado o creado", ['user_id' => $user->id]);

        // Actualizar estado del usuario a activo si está pendiente
        if ($user->estado == 'pendiente') {
            $user->estado = 'activo';
            $user->save();
            Log::info("Estado del usuario actualizado a activo", ['user_id' => $user->id]);
        }

        Log::info("Técnico aprobado exitosamente", ['user_id' => $user->id]);

        return redirect()->route('gestion-usuarios.index')
            ->with('success', 'Técnico aprobado exitosamente.');

    } catch (\Exception $e) {
        Log::error("Error al aprobar técnico", ['id' => $id, 'error' => $e->getMessage()]);
        return redirect()->back()
            ->with('error', 'Error al aprobar el técnico: ' . $e->getMessage());
    }
}

    public function cambiarEstadoTecnico(Request $request, $id)
    {
        try {
            $request->validate([
                'estado' => 'required|in:disponible,ocupado,inactivo',
                'observacion' => 'nullable|string|max:500'
            ]);

            $user = User::findOrFail($id);

            // Verificar que el usuario sea técnico
            if ($user->rol_id != 2) {
                return redirect()->back()
                    ->with('error', 'Solo se pueden modificar estados de usuarios técnicos.');
            }

            // Actualizar estado del técnico
            \App\Models\EstadoTecnico::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'estado' => $request->estado,
                    'observacion' => $request->observacion
                ]
            );

            return redirect()->route('gestion-usuarios.index')
                ->with('success', 'Estado del técnico actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el estado: ' . $e->getMessage());
        }
    }



    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'rol' => 'required|in:usuario,tecnico,admin',
                'estado' => 'required|in:activo,pendiente,suspendido'
            ]);

            // IDs de roles
            $rolIds = [
                'usuario' => 1,
                'tecnico' => 2,
                'admin' => 3,
            ];

            User::create([
                'nombre' => $request->nombre,
                'apellido_paterno' => $request->apellido_paterno,
                'apellido_materno' => $request->apellido_materno,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'rol_id' => $rolIds[$request->rol],
                'estado' => $request->estado,
            ]);

            return redirect()->route('gestion-usuarios.index')
                ->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el usuario: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateEstado(Request $request, $id)
    {
        try {
            $request->validate([
                'estado' => 'required|in:activo,pendiente,suspendido'
            ]);

            $user = User::findOrFail($id);
            $user->estado = $request->estado;
            $user->save();

            return redirect()->route('gestion-usuarios.index')
                ->with('success', 'Estado del usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el estado: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            // Verificar si el usuario tiene incidencias asociadas
            // Descomenta cuando tengas el modelo Incidencia
            // if ($user->incidencias()->exists()) {
            //     return redirect()->back()
            //         ->with('error', 'No se puede eliminar el usuario porque tiene incidencias asociadas.');
            // }

            $user->delete();

            return redirect()->route('gestion-usuarios.index')
                ->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el usuario: ' . $e->getMessage());
        }
    }
}
