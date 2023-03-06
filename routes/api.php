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

// cria as rotas create e edit por padrao
//Route::resource('cliente', 'App\Http\Controllers\ClienteController');

// nao mapeia as rotas create e edit, pois apenas documentos contendo o estado de determinado conteudo eh trafegado
Route::apiResource('cliente', 'App\Http\Controllers\ClienteController');

Route::apiResource('carro', 'App\Http\Controllers\CarroController');
Route::apiResource('locacao', 'App\Http\Controllers\LocacaoController');
Route::apiResource('marca', 'App\Http\Controllers\MarcaController');
Route::apiResource('modelo', 'App\Http\Controllers\ModeloController');

//Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('login', [\App\Http\Controllers\AuthController::class,'login']);
Route::post('logout', [\App\Http\Controllers\AuthController::class,'logout']);
Route::post('refresh', [\App\Http\Controllers\AuthController::class,'refresh']);
Route::post('me', [\App\Http\Controllers\AuthController::class,'me']);
