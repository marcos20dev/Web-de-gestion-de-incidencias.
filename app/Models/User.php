<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'rol',
        'estado',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Roles disponibles
    const ROLES = [
        'usuario' => 'Usuario',
        'tecnico' => 'Técnico',
        'admin' => 'Administrador'
    ];

    // Estados disponibles
    const ESTADOS = [
        'pendiente' => 'Pendiente',
        'activo' => 'Activo',
        'suspendido' => 'Suspendido'
    ];

    /**
     * Verificar si la cuenta está activa
     */
    public function isActive()
    {
        return $this->estado === 'activo';
    }

    /**
     * Verificar si la cuenta está pendiente
     */
    public function isPending()
    {
        return $this->estado === 'pendiente';
    }

    /**
     * Verificar si la cuenta está suspendida
     */
    public function isSuspended()
    {
        return $this->estado === 'suspendido';
    }

    /**
     * Verificar si el usuario es administrador
     */
    public function isAdmin()
    {
        return $this->rol === 'admin';
    }

    /**
     * Verificar si el usuario es técnico
     */
    public function isTecnico()
    {
        return $this->rol === 'tecnico';
    }

    /**
     * Verificar si el usuario es usuario regular
     */
    public function isUsuario()
    {
        return $this->rol === 'usuario';
    }

    /**
     * Obtener el nombre completo
     */
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno;
    }

    /**
     * Scope para usuarios activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    /**
     * Scope para usuarios pendientes
     */
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    /**
     * Scope por rol
     */
    public function scopePorRol($query, $rol)
    {
        return $query->where('rol', $rol);
    }


    public function rolData()
    {
        return $this->belongsTo(Rol::class, 'rol', 'nombre');
    }




}
