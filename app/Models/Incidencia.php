<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_incidencias';
    protected $fillable = [
        'titulo',
        'descripcion',
        'prioridad',
        'estado',
        'categoria', // Mantener por compatibilidad
        'categoria_id', // Nueva relación
        'ubicacion',
        'usuario_id',
        'tecnico_id',
        'fecha_limite',
        'fecha_asignacion',
        'fecha_resolucion',
        'solucion',
        'comentarios',
        'imagen_evidencia', // NUEVO CAMPO
    ];

    protected $casts = [
        'fecha_limite' => 'datetime',
        'fecha_asignacion' => 'datetime',
        'fecha_resolucion' => 'datetime',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    // Nueva relación con categoría
    public function categoriaRelacion()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Método para obtener la categoría (compatibilidad)
    public function getCategoriaAttribute()
    {
        return $this->categoriaRelacion ? $this->categoriaRelacion->nombre : 'General';
    }

    // Método para obtener la imagen como URL de datos
    public function getImagenEvidenciaUrlAttribute()
    {
        if ($this->imagen_evidencia) {
            return 'data:image/jpeg;base64,' . $this->imagen_evidencia;
        }
        return null;
    }

    // Método para verificar si tiene imagen
    public function getTieneImagenAttribute()
    {
        return !empty($this->imagen_evidencia);
    }

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeAsignadas($query)
    {
        return $query->where('estado', 'asignada');
    }

    public function scopeEnProceso($query)
    {
        return $query->where('estado', 'en_proceso');
    }

    public function scopeResueltas($query)
    {
        return $query->where('estado', 'resuelta');
    }

    public function scopeDelUsuario($query, $usuarioId)
    {
        return $query->where('usuario_id', $usuarioId);
    }

    public function scopeDelTecnico($query, $tecnicoId)
    {
        return $query->where('tecnico_id', $tecnicoId);
    }

    // Métodos de ayuda
    public function getPrioridadColorAttribute()
    {
        return [
            'baja' => 'green',
            'media' => 'yellow',
            'alta' => 'orange',
            'critica' => 'red'
        ][$this->prioridad] ?? 'gray';
    }

    public function getEstadoColorAttribute()
    {
        return [
            'pendiente' => 'yellow',
            'asignada' => 'blue',
            'en_proceso' => 'purple',
            'resuelta' => 'green',
            'cerrada' => 'gray'
        ][$this->estado] ?? 'gray';
    }

    public function puedeSerEditadaPor($usuario)
    {
        return $usuario->id === $this->usuario_id ||
            $usuario->id === $this->tecnico_id ||
            $usuario->isAdmin();
    }

    // Método para calcular días restantes
    public function getDiasRestantesAttribute()
    {
        if (!$this->fecha_limite) {
            return null;
        }

        $now = now();
        $fechaLimite = $this->fecha_limite;

        if ($fechaLimite < $now) {
            return -$fechaLimite->diffInDays($now); // Negativo si está vencido
        }

        return $fechaLimite->diffInDays($now);
    }

    // Método para verificar si está vencida
    public function getEstaVencidaAttribute()
    {
        if (!$this->fecha_limite) {
            return false;
        }

        return $this->fecha_limite < now() && !in_array($this->estado, ['resuelta', 'cerrada']);
    }
    // En App\Models\Incidencia
    public function solicitudesAprobacion()
    {
        return $this->hasMany(SolicitudAprobacion::class, 'incidencia_id', 'id_incidencias');
    }

    public function tieneSolicitudesPendientes()
    {
        return $this->solicitudesAprobacion()->where('estado', 'pendiente')->exists();
    }

    public function getSolicitudAprobacionPendienteAttribute()
    {
        return $this->solicitudesAprobacion()->where('estado', 'pendiente')->first();
    }
}
