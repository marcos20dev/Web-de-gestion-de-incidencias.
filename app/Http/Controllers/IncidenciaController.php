<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    public function create()
    {
        // Obtener solo categorías activas
        $categorias = Categoria::where('activo', true)
            ->orderBy('nombre')
            ->get();

        return view('incidencias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:baja,media,alta,critica',
            'categoria_id' => 'required|exists:categorias,id_categorias',
            'ubicacion' => 'nullable|string|max:255',
            'fecha_limite' => 'nullable|date|after:today',
            'imagen_evidencia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB
        ]);

        // Obtener la categoría para guardar su nombre
        $categoria = Categoria::find($validated['categoria_id']);

        // Procesar imagen si existe
        $imagenBase64 = null;
        if ($request->hasFile('imagen_evidencia')) {
            $imagen = $request->file('imagen_evidencia');
            $imagenBase64 = base64_encode(file_get_contents($imagen->getRealPath()));
        }

        Incidencia::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'prioridad' => $validated['prioridad'],
            'categoria' => $categoria->nombre,
            'categoria_id' => $validated['categoria_id'],
            'ubicacion' => $validated['ubicacion'],
            'fecha_limite' => $validated['fecha_limite'],
            'imagen_evidencia' => $imagenBase64, // Nuevo campo
            'usuario_id' => Auth::id(),
            'estado' => 'pendiente',
        ]);

        return redirect()->route('incidencias.mis')
            ->with('success', 'Incidencia registrada correctamente. Será asignada a un técnico pronto.');
    }


    public function misIncidencias()
    {
        $incidencias = Incidencia::where('usuario_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('incidencias.mis-incidencias', compact('incidencias'));
    }

    public function asignadas()
    {
        $incidencias = Incidencia::where('tecnico_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('incidencias.incidencias_asignadas', compact('incidencias'));
    }

    public function showAsignada($id)
    {
        $incidencia = Incidencia::with(['usuario', 'categoriaRelacion'])
            ->where('id_incidencias', $id)
            ->where('tecnico_id', Auth::id())
            ->firstOrFail();

        return view('incidencias.detalle_incidencias_asginadas', compact('incidencia'));
    }

    public function updateAsignada(Request $request, $id)
    {
        $incidencia = Incidencia::where('id_incidencias', $id)
            ->where('tecnico_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'solucion' => 'nullable|string',
            'comentarios' => 'nullable|string',
            'estado' => 'required|in:asignada,en_proceso,resuelta,cerrada'
        ]);

        // Si se marca como resuelta, guardar fecha de resolución
        if ($validated['estado'] == 'resuelta' && $incidencia->estado != 'resuelta') {
            $validated['fecha_resolucion'] = now();
        }

        // Si se cambia a en_proceso y estaba asignada
        if ($validated['estado'] == 'en_proceso' && $incidencia->estado == 'asignada') {
            $validated['fecha_inicio'] = now();
        }

        $incidencia->update($validated);

        return redirect()->route('incidencias.asignadas.show', $incidencia)
            ->with('success', 'Incidencia actualizada correctamente.');
    }

    public function cambiarEstado(Request $request, $id)
    {
        $incidencia = Incidencia::where('id_incidencias', $id)
            ->where('tecnico_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'estado' => 'required|in:en_proceso,resuelta'
        ]);

        $updates = ['estado' => $request->estado];

        if ($request->estado == 'en_proceso') {
            $updates['fecha_inicio'] = now();
        } elseif ($request->estado == 'resuelta') {
            $updates['fecha_resolucion'] = now();
        }

        $incidencia->update($updates);

        return response()->json(['success' => true]);
    }

    public function showUsuario($id)
    {
        $incidencia = Incidencia::with(['usuario', 'tecnico', 'categoriaRelacion'])
            ->where('id_incidencias', $id)
            ->where('usuario_id', Auth::id()) // Solo puede ver sus propias incidencias
            ->firstOrFail();

        return view('incidencias.show-usuario', compact('incidencia'));
    }


    
    public function todas()
    {
        $incidencias = Incidencia::with(['usuario', 'tecnico'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('incidencias.todas_incidencias', compact('incidencias'));
    }

    public function show($id)
    {
        $incidencia = Incidencia::with(['usuario', 'tecnico', 'categoriaRelacion'])->findOrFail($id);

        // Obtener técnicos con la relación estadosTecnico
        $tecnicos = User::where('rol_id', 2)
            ->where('estado', 'activo')
            ->with(['estadosTecnico' => function ($query) {
                $query->latest()->limit(1); // Solo el último estado
            }])
            ->get(['id', 'nombre', 'apellido_paterno', 'apellido_materno', 'email', 'rol_id']);

        return view('incidencias.show', compact('incidencia', 'tecnicos'));
    }


    public function asignarTecnico(Request $request, $id)
    {
        $incidencia = Incidencia::findOrFail($id);

        $request->validate([
            'tecnico_id' => 'required|exists:users,id'
        ]);

        $incidencia->update([
            'tecnico_id' => $request->tecnico_id,
            'fecha_asignacion' => now(),
            'estado' => 'asignada'
        ]);

        return redirect()->back()->with('success', 'Técnico asignado correctamente.');
    }

    public function edit(Incidencia $incidencia)
    {
        if (!$incidencia->puedeSerEditadaPor(Auth::user())) {
            abort(403, 'No tienes permisos para editar esta incidencia.');
        }

        $tecnicos = User::whereHas('rol', function ($query) {
            $query->where('nombre', 'Técnico');
        })->get();

        // Obtener categorías activas para el formulario de edición
        $categorias = Categoria::where('activo', true)
            ->orderBy('nombre')
            ->get();

        return view('incidencias.edit', compact('incidencia', 'tecnicos', 'categorias'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        if (!$incidencia->puedeSerEditadaPor(Auth::user())) {
            abort(403, 'No tienes permisos para editar esta incidencia.');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:baja,media,alta,critica',
            'categoria_id' => 'required|exists:categorias,id_categorias',
            'estado' => 'required|in:pendiente,asignada,en_proceso,resuelta,cerrada',
            'tecnico_id' => 'nullable|exists:users,id',
            'solucion' => 'nullable|string',
            'comentarios' => 'nullable|string',
        ]);

        // Obtener la categoría para actualizar el nombre
        $categoria = Categoria::find($validated['categoria_id']);
        $validated['categoria'] = $categoria->nombre;

        // Si se asigna un técnico y el estado es pendiente, cambiar a asignada
        if ($validated['tecnico_id'] && $incidencia->estado == 'pendiente') {
            $validated['estado'] = 'asignada';
            $validated['fecha_asignacion'] = now();
        }

        // Si se marca como resuelta, guardar fecha de resolución
        if ($validated['estado'] == 'resuelta' && $incidencia->estado != 'resuelta') {
            $validated['fecha_resolucion'] = now();
        }

        $incidencia->update($validated);

        return redirect()->route('incidencias.show', $incidencia)
            ->with('success', 'Incidencia actualizada correctamente.');
    }


    public function general()
    {
        $incidencias = Incidencia::with(['usuario', 'tecnico'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calcular las estadísticas
        $totalIncidencias = Incidencia::count();
        $pendientes = Incidencia::where('estado', 'pendiente')->count();
        $enProceso = Incidencia::where('estado', 'en_proceso')->count();
        $resueltas = Incidencia::whereIn('estado', ['resuelta', 'cerrada'])->count();

        return view('incidencias.todas_incidencias', compact(
            'incidencias',
            'totalIncidencias',
            'pendientes',
            'enProceso',
            'resueltas'
        ));
    }
}
