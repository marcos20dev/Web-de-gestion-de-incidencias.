<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'estado',
        'rol_id', // ✅ clave foránea al rol
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación con Rol
     */
    public function rol()
    {
        // Un usuario pertenece a un rol
        return $this->belongsTo(Rol::class, 'rol_id', 'id_roles');
    }
    // En app/Models/User.php
    public function estadosTecnico()
    {
        return $this->hasMany(EstadoTecnico::class, 'user_id');
    }


    public function hasRole($roles)
    {
        // obtiene el nombre del rol del usuario actual
        $userRole = $this->rol ? strtolower($this->rol->nombre) : null;

        // convierte roles a arreglo
        $roles = is_array($roles) ? $roles : [$roles];

        // compara insensible a mayúsculas/minúsculas
        return in_array($userRole, array_map('strtolower', $roles));
    }


    /**
     * Nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->apellido_paterno} {$this->apellido_materno}";
    }
    public function rolData()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }
}
