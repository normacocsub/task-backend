<?php

namespace App\Services;

use App\Repositories\ComentarioRepository;
use App\Repositories\TareaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComentarioService
{
    protected $comentarioRepository;
    protected $tareaRepository;

    public function __construct(ComentarioRepository $comentarioRepository, TareaRepository $tareaRepository)
    {
        $this->comentarioRepository = $comentarioRepository;
        $this->tareaRepository = $tareaRepository;
    }

    public function create(Request $request)
    {
        $tarea = $this->tareaRepository->obtenerTarea($request->tarea_id);
        if (!$tarea) return null;
        return $this->comentarioRepository->create($request, $tarea->id);
    }

    public function obtenerComentario($id)
    {
        return $this->comentarioRepository->obtenerComentario($id);
    }

    public function actualizarComentario(Request $request)
    {
        $comentario = $this->comentarioRepository->obtenerComentario($request->id);
        Log::info($comentario);
        if (!$comentario) return null;
        return $this->comentarioRepository->actualizarComentario($request);
    }

    public function eliminarAdjunto($id)
    {
        $comentario = $this->comentarioRepository->obtenerComentario($id);
        if (!$comentario) return null;
        return $this->comentarioRepository->eliminarAdjunto($id);
    }

    public function eliminarComentario($id)
    {
        $comentario = $this->comentarioRepository->obtenerComentario($id);
        if (!$comentario) return null;
        return $this->comentarioRepository->eliminarComentario($id);
    }
}
