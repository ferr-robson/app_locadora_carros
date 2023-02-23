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

// para acessar essa rota: <localhost/api/>
Route::get('/', function () {
    // navegador > f12 > Network > f5 > localhost/ ou api/ > headers
    //return view('welcome');
    // O return view('welcome'); vai ter no Response Header, um Content-Type "text/html"

    return ['Chegamos ate aqui' => 'SIM'];
    // O return [''=>''] vai ter no Response Header, um content-type "application/json"
});