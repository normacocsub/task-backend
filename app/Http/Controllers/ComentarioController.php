<?php
namespace App\Http\Controllers;

use App\Services\ComentarioService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    protected $comentarioService;

    public function __construct(ComentarioService $comentarioService)
    {
        $this->comentarioService = $comentarioService;
    }

    public function create(Request $request)
    {
        $response = $this->comentarioService->create($request);
        if (!$response) return response()->json(['error' => 'No se encuentra la tarea'], 404);
        return $this->returnResponse($response);
    }

    public function obtenerComentario($id)
    {
        $response = $this->comentarioService->obtenerComentario($id);
        if (!$response) return response()->json(['error' => 'No se encuentro el comentario'], 404);
        return $this->returnResponse($response);
    }

    public function actualizarComentario(Request $request)
    {
        $response = $this->comentarioService->actualizarComentario($request);
        if (!$response) return response()->json(['error' => 'No se encuentro el comentario'], 404);
        return $this->returnResponse($response);
    }

    public function eliminarAdjunto($id)
    {
        $response = $this->comentarioService->eliminarAdjunto($id);
        if (!$response) return response()->json(['error' => 'No se encuentro el comentario'], 404);
        return $this->returnResponse($response);
    }

    public function eliminarComentario($id)
    {
        $response = $this->comentarioService->eliminarComentario($id);
        if (!$response) return response()->json(['error' => 'No se encuentro el comentario'], 404);
        return $this->returnResponse($response);
    }
}
