<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjuntos extends Model
{
    use HasFactory;
    protected $table = 'adjuntos';

    protected $fillable = [
        'nombre', 'url'
    ];
}
