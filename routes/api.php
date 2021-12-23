<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', [LoginController::class, 'userAuth']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::post('/login', [LoginController::class, 'login']);


Route::middleware('throttle:100000,1')->group(function () {
    Route::post('restore/anuncios', [App\Http\Controllers\Migrations\AnuncioController::class, 'restore']);
    Route::post('restore/usuarios', [App\Http\Controllers\Migrations\UsuarioController::class, 'restore']);
    Route::post('restore/pacientes', [App\Http\Controllers\Migrations\PacienteController::class, 'restore']);
});
