<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Incidencia;
use App\Models\SolicitudAprobacion;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔍 DEBUG: Verificar datos del usuario
        Log::info('Dashboard - Usuario:', [
            'user_id' => $user->id,
            'nombre' => $user->nombre,
            'rol_id' => $user->rol_id,
            'rol' => $user->rol
        ]);

        // Obtener nombre del rol de forma segura
        $rolNombre = 'Sin rol';
        if ($user->rol) {
            $rolNombre = $user->rol->nombre;
        }

        // ✅ Normalizar nombre del rol
        $rolNormalizado = $this->normalizarRol($rolNombre);

        // 📊 Obtener estadísticas según el rol
        $estadisticas = $this->obtenerEstadisticasPorRol($user, $rolNormalizado);

        // ⚡ Acciones rápidas según el rol
        $accionesRapidas = $this->obtenerAccionesRapidasPorRol($user, $rolNormalizado);

        // 🧩 Obtener incidencias según el rol
        $incidenciasRecientes = $this->obtenerIncidenciasRecientes($user, $rolNormalizado);

        // 📈 NUEVO - Obtener datos para gráficos
        $datosGraficos = $this->obtenerDatosGraficos($user, $rolNormalizado);

        return view('dashboard.index', compact(
            'user',
            'rolNormalizado',
            'estadisticas',
            'accionesRapidas',
            'incidenciasRecientes',
            'datosGraficos'
        ));
    }

    private function normalizarRol($rolNombre)
    {
        if (!$rolNombre) return 'sin_rol';

        return strtolower(str_replace(
            ['á', 'é', 'í', 'ó', 'ú', ' '],
            ['a', 'e', 'i', 'o', 'u', '_'],
            trim($rolNombre)
        ));
    }

    private function obtenerEstadisticasPorRol($user, $rolNormalizado)
    {
        switch ($rolNormalizado) {
            case 'tecnico':
                return [
                    'incidencias_asignadas' => Incidencia::where('tecnico_id', $user->id)->count(),
                    'en_proceso' => Incidencia::where('tecnico_id', $user->id)->where('estado', 'en_proceso')->count(),
                    'pendientes' => Incidencia::where('tecnico_id', $user->id)->where('estado', 'pendiente')->count(),
                    'resueltas' => Incidencia::where('tecnico_id', $user->id)->whereIn('estado', ['resuelta', 'cerrada'])->count(),
                    'solicitudes_enviadas' => SolicitudAprobacion::where('tecnico_id', $user->id)->count(),
                    'solicitudes_pendientes' => SolicitudAprobacion::where('tecnico_id', $user->id)->where('estado', 'pendiente')->count(),
                ];

            case 'supervisor':
                return [
                    'incidencias_totales' => Incidencia::count(),
                    'incidencias_pendientes' => Incidencia::where('estado', 'pendiente')->count(),
                    'incidencias_proceso' => Incidencia::where('estado', 'en_proceso')->count(),
                    'incidencias_resueltas' => Incidencia::whereIn('estado', ['resuelta', 'cerrada'])->count(),
                    'solicitudes_totales' => SolicitudAprobacion::count(),
                    'solicitudes_pendientes' => SolicitudAprobacion::where('estado', 'pendiente')->count(),
                ];

            case 'usuario':
                return [
                    'mis_incidencias' => Incidencia::where('usuario_id', $user->id)->count(),
                    'incidencias_pendientes' => Incidencia::where('usuario_id', $user->id)->where('estado', 'pendiente')->count(),
                    'incidencias_proceso' => Incidencia::where('usuario_id', $user->id)->where('estado', 'en_proceso')->count(),
                    'incidencias_resueltas' => Incidencia::where('usuario_id', $user->id)->whereIn('estado', ['resuelta', 'cerrada'])->count(),
                    'incidencias_urgentes' => Incidencia::where('usuario_id', $user->id)->where('prioridad', 'alta')->count(),
                ];

            default:
                return [
                    'mis_incidencias' => 0,
                    'incidencias_pendientes' => 0,
                    'incidencias_proceso' => 0,
                    'incidencias_resueltas' => 0,
                    'incidencias_urgentes' => 0,
                ];
        }
    }

    // 📈 NUEVA FUNCIÓN - Obtener datos para gráficos
    private function obtenerDatosGraficos($user, $rolNormalizado)
    {
        $graficos = [];

        if ($rolNormalizado === 'tecnico') {
            // Estado de incidencias del técnico
            $graficos['estado'] = [
                'labels' => ['Pendiente', 'Asignada', 'En Proceso'],
                'data' => [
                    Incidencia::where('tecnico_id', $user->id)->where('estado', 'pendiente')->count(),
                    Incidencia::where('tecnico_id', $user->id)->where('estado', 'asignada')->count(),
                    Incidencia::where('tecnico_id', $user->id)->where('estado', 'en_proceso')->count(),
                ]
            ];

            // Prioridad
            $graficos['prioridad'] = [
                'labels' => ['Alta', 'Media', 'Baja'],
                'data' => [
                    Incidencia::where('tecnico_id', $user->id)->where('prioridad', 'alta')->count(),
                    Incidencia::where('tecnico_id', $user->id)->where('prioridad', 'media')->count(),
                    Incidencia::where('tecnico_id', $user->id)->where('prioridad', 'baja')->count(),
                ]
            ];

            // Solicitudes
            $graficos['solicitudes'] = [
                'labels' => ['Aprobadas', 'Pendientes', 'Rechazadas'],
                'data' => [
                    SolicitudAprobacion::where('tecnico_id', $user->id)->where('estado', 'aprobada')->count(),
                    SolicitudAprobacion::where('tecnico_id', $user->id)->where('estado', 'pendiente')->count(),
                    SolicitudAprobacion::where('tecnico_id', $user->id)->where('estado', 'rechazada')->count(),
                ]
            ];

            // Tendencia últimos 7 días
            $graficos['tendencia'] = $this->obtenerTendencia($user->id, 'tecnico_id');

        } elseif ($rolNormalizado === 'supervisor') {
            // Estado general
            $graficos['estado'] = [
                'labels' => ['Pendiente', 'En Proceso', 'Resueltas', 'Cerradas'],
                'data' => [
                    Incidencia::where('estado', 'pendiente')->count(),
                    Incidencia::where('estado', 'en_proceso')->count(),
                    Incidencia::where('estado', 'resuelta')->count(),
                    Incidencia::where('estado', 'cerrada')->count(),
                ]
            ];

            // Prioridad general
            $graficos['prioridad'] = [
                'labels' => ['Alta', 'Media', 'Baja'],
                'data' => [
                    Incidencia::where('prioridad', 'alta')->count(),
                    Incidencia::where('prioridad', 'media')->count(),
                    Incidencia::where('prioridad', 'baja')->count(),
                ]
            ];

            // Solicitudes
            $graficos['solicitudes'] = [
                'labels' => ['Aprobadas', 'Pendientes', 'Rechazadas'],
                'data' => [
                    SolicitudAprobacion::where('estado', 'aprobada')->count(),
                    SolicitudAprobacion::where('estado', 'pendiente')->count(),
                    SolicitudAprobacion::where('estado', 'rechazada')->count(),
                ]
            ];

            // Tendencia general
            $graficos['tendencia'] = $this->obtenerTendenciaGeneral();

            // Categorías más comunes
            $graficos['categorias'] = $this->obtenerCategorias();

            // Desempeño técnicos
            $graficos['tecnicos'] = $this->obtenerDesempenoTecnicos();

        } elseif ($rolNormalizado === 'usuario') {
            // Estado mis incidencias
            $graficos['estado'] = [
                'labels' => ['Pendiente', 'En Proceso', 'Resueltas', 'Cerradas'],
                'data' => [
                    Incidencia::where('usuario_id', $user->id)->where('estado', 'pendiente')->count(),
                    Incidencia::where('usuario_id', $user->id)->where('estado', 'en_proceso')->count(),
                    Incidencia::where('usuario_id', $user->id)->where('estado', 'resuelta')->count(),
                    Incidencia::where('usuario_id', $user->id)->where('estado', 'cerrada')->count(),
                ]
            ];

            // Prioridad
            $graficos['prioridad'] = [
                'labels' => ['Alta', 'Media', 'Baja'],
                'data' => [
                    Incidencia::where('usuario_id', $user->id)->where('prioridad', 'alta')->count(),
                    Incidencia::where('usuario_id', $user->id)->where('prioridad', 'media')->count(),
                    Incidencia::where('usuario_id', $user->id)->where('prioridad', 'baja')->count(),
                ]
            ];

            // Tendencia
            $graficos['tendencia'] = $this->obtenerTendencia($user->id, 'usuario_id');
        }

        return $graficos;
    }

    // 📈 Obtener tendencia de incidencias (últimos 7 días)
    private function obtenerTendencia($userId, $campo)
    {
        $datos = [];
        $etiquetas = [];

        for ($i = 6; $i >= 0; $i--) {
            $fecha = Carbon::now()->subDays($i)->format('Y-m-d');
            $etiqueta = Carbon::now()->subDays($i)->format('D');

            $count = Incidencia::whereDate('created_at', $fecha)
                ->where($campo, $userId)
                ->count();

            $etiquetas[] = $etiqueta;
            $datos[] = $count;
        }

        return [
            'labels' => $etiquetas,
            'data' => $datos
        ];
    }

    // 📈 Tendencia general para supervisor
    private function obtenerTendenciaGeneral()
    {
        $datos = [];
        $etiquetas = [];

        for ($i = 6; $i >= 0; $i--) {
            $fecha = Carbon::now()->subDays($i)->format('Y-m-d');
            $etiqueta = Carbon::now()->subDays($i)->format('D');

            $count = Incidencia::whereDate('created_at', $fecha)->count();

            $etiquetas[] = $etiqueta;
            $datos[] = $count;
        }

        return [
            'labels' => $etiquetas,
            'data' => $datos
        ];
    }

    // 📈 Categorías más comunes
    private function obtenerCategorias()
    {
        $categorias = Incidencia::selectRaw('categoria, COUNT(*) as total')
            ->groupBy('categoria')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'labels' => $categorias->pluck('categoria')->toArray(),
            'data' => $categorias->pluck('total')->toArray()
        ];
    }

    // 📈 Desempeño de técnicos
    private function obtenerDesempenoTecnicos()
    {
        $tecnicos = Incidencia::where('tecnico_id', '!=', null)
            ->groupBy('tecnico_id')
            ->selectRaw('tecnico_id, COUNT(*) as total')
            ->with('tecnico')
            ->limit(5)
            ->get();

        $labels = [];
        $resueltas = [];
        $enProceso = [];

        foreach ($tecnicos as $tecnico) {
            if ($tecnico->tecnico) {
                $labels[] = $tecnico->tecnico->nombre;

                // Contar resueltas para este técnico
                $resueltsCount = Incidencia::where('tecnico_id', $tecnico->tecnico_id)
                    ->whereIn('estado', ['resuelta', 'cerrada'])
                    ->count();

                $resueltas[] = $resueltsCount;
                $enProceso[] = $tecnico->total - $resueltsCount;
            }
        }

        return [
            'labels' => $labels,
            'resueltas' => $resueltas,
            'enProceso' => $enProceso
        ];
    }

    private function obtenerAccionesRapidasPorRol($user, $rolNormalizado)
    {
        switch ($rolNormalizado) {
            case 'tecnico':
                $acciones = [
                    [
                        'icono' => 'fas fa-tools',
                        'titulo' => 'Mis Incidencias Asignadas',
                        'descripcion' => 'Ver todas mis incidencias',
                        'ruta' => route('incidencias.asignadas'),
                        'color' => 'blue'
                    ],
                    [
                        'icono' => 'fas fa-handshake',
                        'titulo' => 'Mis Solicitudes',
                        'descripcion' => 'Ver mis solicitudes enviadas',
                        'ruta' => route('solicitudes.mis'),
                        'color' => 'green'
                    ],
                    [
                        'icono' => 'fas fa-history',
                        'titulo' => 'Historial General',
                        'descripcion' => 'Ver todas mis solicitudes',
                        'ruta' => route('solicitudes.historial'),
                        'color' => 'purple'
                    ]
                ];

                $incidenciaEnProceso = Incidencia::where('tecnico_id', $user->id)
                    ->where('estado', 'en_proceso')
                    ->first();

                if ($incidenciaEnProceso) {
                    $acciones[] = [
                        'icono' => 'fas fa-plus-circle',
                        'titulo' => 'Nueva Solicitud',
                        'descripcion' => 'Crear solicitud de aprobación',
                        'ruta' => route('solicitudes.create', $incidenciaEnProceso->id_incidencias),
                        'color' => 'orange'
                    ];
                }

                return $acciones;

            case 'supervisor':
                return [
                    [
                        'icono' => 'fas fa-list-check',
                        'titulo' => 'Todas las Incidencias',
                        'descripcion' => 'Gestionar todas las incidencias',
                        'ruta' => route('incidencias.general'),
                        'color' => 'blue'
                    ],
                    [
                        'icono' => 'fas fa-clipboard-check',
                        'titulo' => 'Solicitudes Pendientes',
                        'descripcion' => 'Revisar solicitudes de aprobación',
                        'ruta' => route('solicitudes.historial'),
                        'color' => 'orange'
                    ],
                    [
                        'icono' => 'fas fa-chart-bar',
                        'titulo' => 'Estadísticas',
                        'descripcion' => 'Ver reportes y estadísticas',
                        'ruta' => '#',
                        'color' => 'green'
                    ],
                    [
                        'icono' => 'fas fa-users',
                        'titulo' => 'Gestión de Técnicos',
                        'descripcion' => 'Administrar técnicos',
                        'ruta' => route('gestion-usuarios.index'),
                        'color' => 'purple'
                    ]
                ];

            case 'usuario':
                return [
                    [
                        'icono' => 'fas fa-plus-circle',
                        'titulo' => 'Nueva Incidencia',
                        'descripcion' => 'Reportar un nuevo problema',
                        'ruta' => route('incidencias.create'),
                        'color' => 'blue'
                    ],
                    [
                        'icono' => 'fas fa-list',
                        'titulo' => 'Mis Incidencias',
                        'descripcion' => 'Ver todas mis incidencias reportadas',
                        'ruta' => route('incidencias.mis'),
                        'color' => 'green'
                    ],
                    [
                        'icono' => 'fas fa-clock',
                        'titulo' => 'Incidencias Pendientes',
                        'descripcion' => 'Ver incidencias en espera',
                        'ruta' => route('incidencias.mis') . '?estado=pendiente',
                        'color' => 'orange'
                    ],
                    [
                        'icono' => 'fas fa-check-circle',
                        'titulo' => 'Incidencias Resueltas',
                        'descripcion' => 'Ver problemas solucionados',
                        'ruta' => route('incidencias.mis') . '?estado=resuelta',
                        'color' => 'purple'
                    ]
                ];

            default:
                return [
                    [
                        'icono' => 'fas fa-home',
                        'titulo' => 'Dashboard',
                        'descripcion' => 'Volver al inicio',
                        'ruta' => route('dashboard'),
                        'color' => 'blue'
                    ]
                ];
        }
    }

    private function obtenerIncidenciasRecientes($user, $rolNormalizado)
    {
        switch ($rolNormalizado) {
            case 'tecnico':
                return Incidencia::where('tecnico_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

            case 'supervisor':
                return Incidencia::with('tecnico')
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

            case 'usuario':
                return Incidencia::where('usuario_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

            default:
                return [];
        }
    }
}
