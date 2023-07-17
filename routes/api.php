<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArticuloController;



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

// Route::get('/clients', 'App\Http\Controllers\ClientsController@index');

Route::get('/articulo', [ArticuloController::class, 'index']);


Route::get('/clients', [ClientsController::class, 'index']);
Route::post('/clients/listado', [ClientsController::class, 'store']);
Route::get('/clients/vista/{id}', [ClientsController::class, 'show']);
Route::put('/clients/editar/{id}', [ClientsController::class, 'update']);
Route::delete('/clients/eliminar/{id}', [ClientsController::class, 'destroy']);

Route::get('/servicios', [ServiceController::class, 'index']);
Route::post('/servicios/listado', [ServiceController::class, 'store']);
Route::get('/servicios/vista/{id}', [ServiceController::class, 'show']);
Route::put('/servicios/editar/{id}', [ServiceController::class, 'update']);
Route::delete('/servicios/eliminar/{id}', [ServiceController::class, 'destroy']);

Route::post('clientes/servicios', [ClientsController::class, 'attach']);
Route::post('clientes/servicios/detach', [ClientsController::class, 'detach']);

Route::post('servicios/clientes', [ServiceController::class, 'clients']);



