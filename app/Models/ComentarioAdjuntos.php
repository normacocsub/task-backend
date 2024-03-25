<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioAdjuntos extends Model
{
    use HasFactory;
    protected $table = 'comentario_adjuntos';
    public function adjuntos()
    {
        return $this->belongsTo(Adjuntos::class, 'adjuntos_id');
    }
}
