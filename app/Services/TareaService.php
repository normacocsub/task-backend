<?php

namespace App\Services;

use App\Models\Tarea;
use App\Repositories\ComentarioRepository;
use App\Repositories\TareaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TareaService
{
    protected $tareaRepository;
    protected $comentarioRepository;

    public function __construct(TareaRepository $repository, ComentarioRepository $comentarioRepository)
    {
        $this->tareaRepository = $repository;
        $this->comentarioRepository = $comentarioRepository;
    }

    public function create(Request $request)
    {
        return $this->tareaRepository->create($request);
    }

    public function obtenerTarea(string $id)
    {
        $tarea = $this->tareaRepository->obtenerTarea($id);
        if (!$tarea) return null;
        return $tarea;
    }

    public function obtenerTareas()
    {
        return $this->tareaRepository->obtenerTareas();
    }

    public function actualizarTarea(Request $request)
    {
        $tarea = $this->obtenerTarea($request->id);
        if (!$tarea) return null;
        return $this->tareaRepository->actualizarTarea($request);
    }

    public function actualizarEstado(string $estado, string $id)
    {
        return $this->tareaRepository->actualizarEstado($estado, $id);
    }

    public function eliminarTarea($id)
    {
        $tarea = $this->tareaRepository->obtenerTarea($id);
        if (!$tarea) return null;
        foreach ($tarea->comentarios as $comentario)
        {
            $this->comentarioRepository->eliminarComentario($comentario->id);
        }
        return $this->tareaRepository->eliminarTarea($id);
    }
}
