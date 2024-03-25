<?php

namespace App\Http\Controllers;

use App\Services\TareaService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    protected $tareaService;

    public function __construct(TareaService $tareaService)
    {
        $this->tareaService = $tareaService;
    }

    public function create(Request $request)
    {
        $response = $this->tareaService->create($request);
        $this->returnResponse($response);
    }

    public function obtenerTarea($id)
    {
        Log::info($id);
        $response = $this->tareaService->obtenerTarea($id);
        if ($response) return $this->returnResponse($response);
        return response()->json(['error' => 'No se encuentra la tarea'], 404);
    }

    public function obtenerTareas()
    {
        return $this->returnResponse($this->tareaService->obtenerTareas());
    }

    public function actualizarTarea(Request $request)
    {
        $response = $this->tareaService->actualizarTarea($request);
        if ($response) return $this->returnResponse($response);
        return response()->json(['error' => 'No se encuentra la tarea'], 404);
    }

    public function actualizarEstado(Request $request)
    {
        $response = $this->tareaService->actualizarEstado($request['estado'], $request['id']);
        if ($response) return $this->returnResponse($response);
        return response()->json(['error' => 'No se encuentra la tarea'], 404);
    }
}
