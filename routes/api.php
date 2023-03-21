<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->middleware('jwt.auth')->group(function() {
    //localhost:8000/api/v1/<cliente ou carro ou locacao ou marca ou modelo>
    Route::apiResource('cliente', 'App\Http\Controllers\ClienteController');
    Route::apiResource('carro', 'App\Http\Controllers\CarroController');
    Route::apiResource('locacao', 'App\Http\Controllers\LocacaoController');
    Route::apiResource('marca', 'App\Http\Controllers\MarcaController');
    Route::apiResource('modelo', 'App\Http\Controllers\ModeloController');

    // Mostra dados contidos no JWT
    Route::post('me', [\App\Http\Controllers\AuthController::class,'me']);
    
    // Invalida o JWT
    Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
});

// Atualiza o JWT (invalida o antigo e retorna um novo)
Route::post('refresh', [\App\Http\Controllers\AuthController::class,'refresh']);

//Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
