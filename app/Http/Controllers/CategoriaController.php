<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        $categoriaEditar = null;
        if ($request->has('editar')) {
            $categoriaEditar = Categoria::find($request->editar);
        }

        $categoriasSugeridas = [
            'Software' => 'Problemas con aplicaciones, programas o sistemas',
            'Hardware' => 'Fallas en equipos, componentes físicos o periféricos',
            'Red' => 'Problemas de conectividad, internet o red local',
            'Seguridad' => 'Temas de acceso, permisos o seguridad informática',
            'Usuario' => 'Solicitudes de usuario, capacitación o acceso',
            'Impresora' => 'Problemas con impresoras, escáneres o multifuncionales',
            'Email' => 'Problemas con correo electrónico o cuentas',
            'Sistema Operativo' => 'Fallas en Windows, Linux, macOS u otros SO',
            'Base de Datos' => 'Problemas con bases de datos o consultas',
            'Backup' => 'Copias de seguridad y recuperación de datos'
        ];

        return view('categorias.index', compact('categorias', 'categoriaEditar', 'categoriasSugeridas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:500',
            'color' => 'required|string|max:7',
        ]);

        try {
            Categoria::create($validated);

            return redirect()->route('categorias.index')
                ->with('success', 'Categoría creada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear la categoría: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $categoria->id_categorias . ',id_categorias',
            'descripcion' => 'nullable|string|max:500',
            'color' => 'required|string|max:7',
            'activo' => 'sometimes|boolean',
        ]);

        try {
            $categoria->update($validated);

            return redirect()->route('categorias.index')
                ->with('success', 'Categoría actualizada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la categoría: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Categoria $categoria)
    {
        try {
            if ($categoria->incidencias()->count() > 0) {
                return redirect()->route('categorias.index')
                    ->with('error', 'No se puede eliminar la categoría porque tiene incidencias asociadas.');
            }

            $categoria->delete();

            return redirect()->route('categorias.index')
                ->with('success', 'Categoría eliminada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->route('categorias.index')
                ->with('error', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }

    public function toggleEstado(Categoria $categoria)
    {
        try {
            $categoria->activo = !$categoria->activo;
            $categoria->save();

            return response()->json([
                'success' => true,
                'estado' => $categoria->activo,
                'message' => 'Estado actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getCategorias()
    {
        $categorias = Categoria::activas()
            ->select('id_categorias', 'nombre', 'descripcion', 'color')
            ->orderBy('nombre')
            ->get();

        return response()->json($categorias);
    }
}
