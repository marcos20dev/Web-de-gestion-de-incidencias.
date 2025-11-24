<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_roles';
    protected $fillable = ['nombre'];
    public $timestamps = true;

    /**
     * Relación con usuarios
     */
    public function users()
    {
        return $this->hasMany(User::class, 'rol_id', 'id_roles');
    }

    /**
     * Relación con permisos
     */
// app/Models/Rol.php
public function permisos()
{
    return $this->belongsToMany(
        Permiso::class,
        'rol_permisos',  // tabla pivote
        'rol_id',        // FK de rol en la pivote
        'id_permisos'    // FK de permiso en la pivote
    )
    ->withPivot('estado') // trae el campo estado
    ->wherePivot('estado', true); // solo permisos activos
}





    /**
     * Determina si el rol es predeterminado del sistema.
     */
    public function isSystemDefault(): bool
    {
        $systemRoles = ['admin', 'tecnico', 'usuario'];
        return in_array(strtolower($this->nombre), $systemRoles);
    }
}
