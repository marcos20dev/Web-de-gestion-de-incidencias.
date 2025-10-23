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
        ]);

        // Obtener la categoría para guardar su nombre
        $categoria = Categoria::find($validated['categoria_id']);

        Incidencia::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'prioridad' => $validated['prioridad'],
            'categoria' => $categoria->nombre, // Guardar el nombre de la categoría
            'categoria_id' => $validated['categoria_id'], // Guardar el ID también si tu modelo lo soporta
            'ubicacion' => $validated['ubicacion'],
            'fecha_limite' => $validated['fecha_limite'],
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

    public function todas()
    {
        $incidencias = Incidencia::with(['usuario', 'tecnico'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('incidencias.todas', compact('incidencias'));
    }

    public function show(Incidencia $incidencia)
    {
        return view('incidencias.show', compact('incidencia'));
    }

    public function edit(Incidencia $incidencia)
    {
        if (!$incidencia->puedeSerEditadaPor(Auth::user())) {
            abort(403, 'No tienes permisos para editar esta incidencia.');
        }

        $tecnicos = User::whereHas('rol', function($query) {
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

    public function asignadas()
    {
        $incidencias = Incidencia::where('tecnico_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('incidencias.asignadas', compact('incidencias'));
    }
}
