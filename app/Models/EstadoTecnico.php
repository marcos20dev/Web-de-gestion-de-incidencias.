<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoTecnico extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'estados_tecnicos';

    protected $fillable = [
        'user_id',
        'estado',
        'observacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
