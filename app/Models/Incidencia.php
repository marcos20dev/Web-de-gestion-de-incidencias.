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
        'comentarios'
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
}
