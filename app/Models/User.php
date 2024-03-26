<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'email', 'hash', 'estado', 'empleado_id'
    ];



    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'user_rols', 'rol_id', 'user_id');
    }
}
