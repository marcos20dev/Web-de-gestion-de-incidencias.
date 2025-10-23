<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_categorias';
    protected $fillable = [
        'nombre',
        'descripcion',
        'color',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    // Relación con incidencias
    public function incidencias()
    {
        return $this->hasMany(Incidencia::class, 'categoria_id', 'id_categorias');
    }

    // Scope para categorías activas
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    // Método para obtener categorías sugeridas
    public function scopeSugeridas($query)
    {
        return $query->whereIn('nombre', [
            'Software', 'Hardware', 'Red', 'Seguridad', 'Usuario',
            'Impresora', 'Email', 'Sistema Operativo', 'Base de Datos'
        ]);
    }
}
