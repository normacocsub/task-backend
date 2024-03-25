<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'tareas';

    protected $fillable = [
        'nombre', 'descripcion', 'estado', 'empleado_id'
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function comentarios()
    {
        return $this->belongsToMany(Comentario::class, 'tarea_comentarios', 'tarea_id', 'comentario_id');
    }
}
