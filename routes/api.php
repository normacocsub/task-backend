<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'create']);
    Route::post('login', [UserController::class, 'login']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'tarea'
], function () {
   Route::post('', [TareaController::class, 'create']);
   Route::get('', [TareaController::class, 'obtenerTareas']);
   Route::get('obtener/{id}', [TareaController::class, 'obtenerTarea']);
   Route::put('', [TareaController::class, 'actualizarTarea']);
   Route::patch('estado', [TareaController::class, 'actualizarEstado']);
   Route::delete('eliminar/{id}', [TareaController::class, 'eliminarTarea']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'comentario'
], function (){
   Route::post('', [ComentarioController::class, 'create']);
   Route::get('obtener/{id}', [ComentarioController::class, 'obtenerComentario']);
   // se trabajo como post debido que no funcionaba con el form-data
   Route::post('actualizar', [ComentarioController::class, 'actualizarComentario']);
   Route::delete('borrar/{id}', [ComentarioController::class, 'eliminarComentario']);
   Route::delete('borrarAdjunto/{id}', [ComentarioController::class, 'eliminarAdjunto']);
});
