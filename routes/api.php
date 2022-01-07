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
    Route::post('restore/casos', [App\Http\Controllers\Migrations\CasoController::class, 'restore']);
    Route::post('restore/seguimientos', [App\Http\Controllers\Migrations\SeguimientoController::class, 'restore']);
});



Route::middleware(['auth:api'])->group(function () {
    Route::get('show-case/{id}', [App\Http\Controllers\Common\CasoController::class, 'show']);
    Route::get('casos', [App\Http\Controllers\Common\CasoController::class, 'getAll']);

    Route::put('update_profile', [App\Http\Controllers\Common\UserController::class, 'updateProfile']);

    Route::prefix('psicologo')->group(function () {
        Route::get('anuncios', [App\Http\Controllers\Psicologo\AnuncioController::class, 'getAll']);
    });

    Route::prefix('admin')->group(function () {
        Route::apiResource('anuncios', App\Http\Controllers\Admin\AnuncioController::class);
        Route::apiResource('users', App\Http\Controllers\Admin\UserController::class);
        Route::put('users/toggle_status/{id}', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus']);
        Route::get('administradores', [App\Http\Controllers\Admin\UserController::class, 'getAdministradores']);
        Route::get('psicologos', [App\Http\Controllers\Admin\UserController::class, 'getPsicologos']);
    });
});
