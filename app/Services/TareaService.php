<?php

namespace App\Services;

use App\Models\Tarea;
use App\Repositories\TareaRepository;
use Illuminate\Http\Request;

class TareaService
{
    protected $tareaRepository;

    public function __construct(TareaRepository $repository)
    {
        $this->tareaRepository = $repository;
    }

    public function create(Request $request) : Tarea
    {
        return $this->tareaRepository->create($request);
    }

    public function obtenerTarea(string $id)
    {
        return $this->tareaRepository->obtenerTarea($id);
    }

    public function obtenerTareas()
    {
        return $this->tareaRepository->obtenerTareas();
    }

    public function actualizarTarea(Request $request)
    {
        return $this->tareaRepository->actualizarTarea($request);
    }

    public function actualizarEstado(string $estado, string $id)
    {
        return $this->actualizarEstado($estado, $id);
    }
}
