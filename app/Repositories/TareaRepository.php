<?php
namespace App\Repositories;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaRepository
{
    public function create(Request $request): Tarea
    {
        $tarea = new Tarea();
        $tarea->fill($request->only(['nombre', 'descripcion', 'estado', 'empleado_id']));
        $tarea->save();
        return $tarea;
    }

    public function obtenerTarea(string $id)
    {
        return Tarea::with('comentarios')->find($id);
    }

    public function obtenerTareas()
    {
        return Tarea::with('comentarios');
    }

    public function actualizarTarea(Request $request)
    {
        $tarea = Tarea::with('comentarios')->find($request->id);
        $tarea->update($request->only(['nombre', 'descripcion']));
        return $tarea;
    }

    public function actualizarEstado(string $estado, string $id)
    {
        $tarea = Tarea::with('comentarios')->find($id);
        $tarea->estado = $estado;
        $tarea->save();
        return $tarea;
    }

    // falta eliminar

}
