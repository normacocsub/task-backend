<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    protected $table = 'comentarios';

    protected $fillable = [
        'nombre', 'descripcion', 'empleado_id'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function adjuntos()
    {
        return $this->belongsToMany(Adjuntos::class, 'comentario_adjuntos', 'comentario_id', 'adjunto_id');
    }
}
