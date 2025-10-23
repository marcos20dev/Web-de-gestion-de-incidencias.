<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_roles';

    protected $fillable = [
        'nombre'
    ];

    public $timestamps = true;

    /**
     * Verificar si es un rol del sistema
     */
    public function isSystemDefault()
    {
        return in_array($this->nombre, ['admin', 'tecnico', 'usuario']);
    }

    /**
     * Relación con usuarios (si decides modificar la tabla users para usar rol_id)
     * Por ahora retornamos una colección vacía hasta que modifiques la migración
     */
    public function usuarios()
    {
        // Si tu tabla users tiene un campo 'rol_id'
        // return $this->hasMany(User::class, 'rol_id', 'id_roles');

        // Por ahora retornamos una colección vacía
        return collect();
    }

    /**
     * Scope para roles personalizados
     */
    public function scopeCustom($query)
    {
        return $query->whereNotIn('nombre', ['admin', 'tecnico', 'usuario']);
    }

    /**
     * Scope para ordenar por nombre
     */
    public function scopeOrderByName($query)
    {
        return $query->orderBy('nombre');
    }

    /**
     * Scope para buscar por nombre
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nombre', 'like', "%{$search}%");
    }
}
