<?php

namespace App\Repositories;

use App\Models\Adjuntos;
use App\Models\Comentario;
use App\Models\ComentarioAdjuntos;
use App\Models\Tarea;
use App\Models\TareaComentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ComentarioRepository
{
    public function create(Request $request, $tarea_id)
    {
        $comentario = new Comentario();
        $tareaComentario = new TareaComentario();
        $comentario->fill($request->only(['titulo', 'descripcion', 'empleado_id']));
        $comentario->save();
        $tareaComentario->tarea_id = $tarea_id;
        $tareaComentario->comentario_id = $comentario->id;
        $tareaComentario->save();
        $archivosAdjuntos = $request->allFiles();
        $this->saveFiles($archivosAdjuntos, $comentario->id);

        return $comentario;
    }

    private function saveFiles($archivosAdjuntos, $comentario_id): void
    {
        foreach ($archivosAdjuntos as $archivo) {
            $fecha = date('Y-m-d_H-i-s') . substr(microtime(true), -4);
            $extension = $archivo->getClientOriginalExtension();
            $nombreArchivo = $fecha . '.' . $extension;
            $rutaArchivo = $archivo->storeAs('adjuntos', $nombreArchivo);
            $rutaArchivo = "adjuntos/" . $nombreArchivo;
            $adjuntos = new Adjuntos();
            $comentarioAdjuntos = new ComentarioAdjuntos();
            $comentarioAdjuntos->comentario_id = $comentario_id;
            $adjuntos->nombre = $nombreArchivo;
            $adjuntos->url = $rutaArchivo;
            $adjuntos->save();
            $comentarioAdjuntos->adjuntos_id = $adjuntos->id;
            $comentarioAdjuntos->save();
        }
    }

    public function obtenerComentario($id)
    {
        return Comentario::with('adjuntos')->find($id);
    }

    public function actualizarComentario(Request $request)
    {
        $comentario = Comentario::query()->find($request->id);
        $comentario->update($request->only(['titulo', 'descripcion']));
        $archivosAdjuntos = $request->allFiles();
        if (count($archivosAdjuntos) == 0 ) return $comentario;
        $this->saveFiles($archivosAdjuntos, $comentario->id);
        return $comentario;
    }

    public function eliminarAdjunto($id)
    {
        $adjunto = Adjuntos::query()->find($id);

        if ($adjunto) {
            if (Storage::exists($adjunto->url)) {
                Storage::delete($adjunto->url);
            }
            $comentarioAdjunto = ComentarioAdjuntos::query()->where('adjuntos_id', $adjunto->id)->first();
            if (!$comentarioAdjunto) return $adjunto;
            $comentarioAdjunto->delete();
            $adjunto->delete();
            return $adjunto;
        }
        return null;
    }

    public function eliminarComentario($id)
    {
        $comentario = Comentario::query()->find($id);
        if ($comentario) {
            $adjuntos = ComentarioAdjuntos::with('adjuntos')->where('comentario_id', $comentario->id)->get();
            foreach ($adjuntos as $adjunto) {
                if (Storage::exists($adjunto->adjuntos->url)) {
                    Storage::delete($adjunto->adjuntos->url);
                }
                $adjunto->delete();
            }
            $tareaComentario = TareaComentario::query()->where('comentario_id', $comentario->id)->first();
            $tareaComentario->delete();
            $comentario->delete();
            return $comentario;
        }
        return null;
    }
}
