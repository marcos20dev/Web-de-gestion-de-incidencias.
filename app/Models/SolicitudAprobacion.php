<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudAprobacion extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_aprobacion';

    protected $fillable = [
        'incidencia_id',
        'tecnico_id',
        'supervisor_id',
        'tipo',
        'titulo',
        'descripcion',
        'justificacion',
        'recursos_solicitados',
        'costo_estimado',
        'estado',
        'comentarios_supervisor',
        'fecha_aprobacion',
        'fecha_rechazo'
    ];

    protected $casts = [
        'costo_estimado' => 'decimal:2',
        'fecha_aprobacion' => 'datetime',
        'fecha_rechazo' => 'datetime',
    ];

    // Relaciones
    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'incidencia_id', 'id_incidencias');
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    // Scopes
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeAprobadas($query)
    {
        return $query->where('estado', 'aprobada');
    }

    public function scopeRechazadas($query)
    {
        return $query->where('estado', 'rechazada');
    }

    // Métodos de utilidad
    public function puedeSerEditada()
    {
        return $this->estado === 'pendiente';
    }

    public function puedeSerAprobada()
    {
        return $this->estado === 'pendiente';
    }

    public function puedeSerRechazada()
    {
        return $this->estado === 'pendiente';
    }

    public function getTipoTextoAttribute()
    {
        $tipos = [
            'aprobacion' => 'Aprobación de Procedimiento',
            'recursos' => 'Solicitud de Recursos',
            'asistencia' => 'Solicitud de Asistencia',
            'otros' => 'Otro Tipo'
        ];

        return $tipos[$this->tipo] ?? $this->tipo;
    }

    public function getColorEstadoAttribute()
    {
        $colores = [
            'pendiente' => 'warning',
            'aprobada' => 'success',
            'rechazada' => 'danger',
            'cancelada' => 'secondary'
        ];

        return $colores[$this->estado] ?? 'secondary';
    }
}
