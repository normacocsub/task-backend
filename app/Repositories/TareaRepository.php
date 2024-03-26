<?php
namespace App\Repositories;
use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TareaRepository
{
    public function create(Request $request)
    {
        $tarea = new Tarea();
        $tarea->fill($request->only(['nombre', 'descripcion', 'estado', 'empleado_id']));
        $tarea->save();
        return $tarea;
    }

    public function obtenerTarea($id)
    {
        $tarea = Tarea::with('comentarios')->find($id);
        Log::info($tarea);
        if(!$tarea) return null;
        return $tarea;
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

   public function eliminarTarea($id)
   {
       $tarea = Tarea::query()->find($id);
       if(!$tarea) return null;
       $tarea->delete();
       return $tarea;
   }

}
