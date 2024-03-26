<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaComentario extends Model
{
    use HasFactory;
    protected $table = 'tarea_comentarios';
    public function comentarios()
    {
        return $this->belongsTo(Comentario::class, 'comentario_id');
    }
}
