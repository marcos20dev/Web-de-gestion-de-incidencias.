<?php

namespace App\Http\Controllers;

use App\Models\SolicitudAprobacion;
use App\Models\Incidencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{
    public function create(Incidencia $incidencia)
    {
        // Verificar que el técnico está asignado a esta incidencia
        if ($incidencia->tecnico_id !== Auth::id()) {
            abort(403, 'No tienes permisos para crear solicitudes en esta incidencia.');
        }

        // Obtener supervisores
        $supervisores = User::whereHas('rol', function($query) {
            $query->whereIn('nombre', ['Supervisor', 'Administrador']);
        })->where('estado', 'activo')->get();

        return view('solicitudes.create', compact('incidencia', 'supervisores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'incidencia_id' => 'required|exists:incidencias,id_incidencias',
            'supervisor_id' => 'required|exists:users,id',
            'tipo' => 'required|in:aprobacion,recursos,asistencia,otros',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'justificacion' => 'required|string',
            'recursos_solicitados' => 'nullable|string',
            'costo_estimado' => 'nullable|numeric|min:0',
        ]);

        // Verificar que el técnico está asignado a la incidencia
        $incidencia = Incidencia::findOrFail($validated['incidencia_id']);
        if ($incidencia->tecnico_id !== Auth::id()) {
            abort(403, 'No tienes permisos para crear solicitudes en esta incidencia.');
        }

        SolicitudAprobacion::create([
            'incidencia_id' => $validated['incidencia_id'],
            'tecnico_id' => Auth::id(),
            'supervisor_id' => $validated['supervisor_id'],
            'tipo' => $validated['tipo'],
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'justificacion' => $validated['justificacion'],
            'recursos_solicitados' => $validated['recursos_solicitados'],
            'costo_estimado' => $validated['costo_estimado'],
            'estado' => 'pendiente',
        ]);

        return redirect()->route('incidencias.asignadas.show', $incidencia)
            ->with('success', 'Solicitud enviada correctamente. Espera la aprobación del supervisor.');
    }

    public function misSolicitudes()
    {
        $solicitudes = SolicitudAprobacion::where('tecnico_id', Auth::id())
            ->with(['incidencia', 'supervisor'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('solicitudes.mis-solicitudes', compact('solicitudes'));
    }

   public function historial(Request $request)
{
    $query = SolicitudAprobacion::with(['incidencia', 'tecnico', 'supervisor'])
                ->orderBy('created_at', 'desc');

    // Aplicar filtros
    if ($request->has('estado') && $request->estado) {
        $query->where('estado', $request->estado);
    }

    if ($request->has('tipo') && $request->tipo) {
        $query->where('tipo', $request->tipo);
    }

    if ($request->has('fecha') && $request->fecha) {
        $query->whereDate('created_at', $request->fecha);
    }

    // Si es técnico, solo ver sus propias solicitudes
    if (Auth::user()->rol_id == 2) { // ID del rol de técnico
        $query->where('tecnico_id', Auth::id());
    }

    $solicitudes = $query->paginate(15);

    // Estadísticas
    $estadisticas = [
        'pendientes' => $query->clone()->where('estado', 'pendiente')->count(),
        'aprobadas' => $query->clone()->where('estado', 'aprobada')->count(),
        'rechazadas' => $query->clone()->where('estado', 'rechazada')->count(),
        'total' => $query->clone()->count(),
    ];

    return view('solicitudes.historial', compact('solicitudes', 'estadisticas'));
}

    public function cancelar(SolicitudAprobacion $solicitud)
    {
        // Solo el técnico que creó la solicitud puede cancelarla
        if ($solicitud->tecnico_id !== Auth::id()) {
            abort(403, 'No tienes permisos para cancelar esta solicitud.');
        }

        // Solo se puede cancelar si está pendiente
        if ($solicitud->estado !== 'pendiente') {
            return redirect()->back()->with('error', 'Solo se pueden cancelar solicitudes pendientes.');
        }

        $solicitud->update([
            'estado' => 'cancelada'
        ]);

        return redirect()->back()->with('success', 'Solicitud cancelada correctamente.');
    }

    public function show(SolicitudAprobacion $solicitud)
    {
        // Verificar permisos
        if ($solicitud->tecnico_id !== Auth::id() &&
            !in_array(Auth::user()->rol_id, [1, 3])) { // IDs de Administrador y Supervisor
            abort(403, 'No tienes permisos para ver esta solicitud.');
        }

        $solicitud->load(['incidencia', 'tecnico', 'supervisor']);

        return view('solicitudes.show', compact('solicitud'));
    }

    public function solicitudesPendientes()
    {
        // Solo para supervisores y administradores (IDs 1 y 3)
        if (!in_array(Auth::user()->rol_id, [1, 3])) {
            abort(403, 'No tienes permisos para ver solicitudes pendientes.');
        }

        $solicitudes = SolicitudAprobacion::with(['incidencia', 'tecnico'])
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('solicitudes.historial', compact('solicitudes'));
    }

    public function aprobar(Request $request, SolicitudAprobacion $solicitud)
    {
        // Solo para supervisores y administradores (IDs 1 y 3)
        if (!in_array(Auth::user()->rol_id, [1, 3])) {
            abort(403, 'No tienes permisos para aprobar solicitudes.');
        }

        $request->validate([
            'comentarios_supervisor' => 'nullable|string'
        ]);

        $solicitud->update([
            'estado' => 'aprobada',
            'comentarios_supervisor' => $request->comentarios_supervisor,
            'fecha_aprobacion' => now(),
            'supervisor_id' => Auth::id(),
        ]);

        return redirect()->route('solicitudes.historial')
            ->with('success', 'Solicitud aprobada correctamente.');
    }

    public function rechazar(Request $request, SolicitudAprobacion $solicitud)
    {
        // Solo para supervisores y administradores (IDs 1 y 3)
        if (!in_array(Auth::user()->rol_id, [1, 3])) {
            abort(403, 'No tienes permisos para rechazar solicitudes.');
        }

        $request->validate([
            'comentarios_supervisor' => 'required|string'
        ]);

        $solicitud->update([
            'estado' => 'rechazada',
            'comentarios_supervisor' => $request->comentarios_supervisor,
            'fecha_rechazo' => now(),
            'supervisor_id' => Auth::id(),
        ]);

        return redirect()->route('solicitudes.pendientes')
            ->with('success', 'Solicitud rechazada correctamente.');
    }

    /**
     * Verificar si el usuario tiene un rol específico (método helper)
     */
    private function userHasRole($roleNames)
    {
        $userRole = Auth::user()->rol->nombre ?? null;

        if (!is_array($roleNames)) {
            $roleNames = [$roleNames];
        }

        return in_array($userRole, $roleNames);
    }
}
