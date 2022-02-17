<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Auth::routes();
// Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('throttle:100000,1')->group(function () {
    Route::post('restore/anuncios', [App\Http\Controllers\Migrations\AnuncioController::class, 'restore']);
    Route::post('restore/usuarios', [App\Http\Controllers\Migrations\UsuarioController::class, 'restore']);
    Route::post('restore/pacientes', [App\Http\Controllers\Migrations\PacienteController::class, 'restore']);
    Route::post('restore/casos', [App\Http\Controllers\Migrations\CasoController::class, 'restore']);
    Route::post('restore/seguimientos', [App\Http\Controllers\Migrations\SeguimientoController::class, 'restore']);
});


Route::get('init-data-case', [
    App\Http\Controllers\Common\CasoController::class, 'initDataCase'
]);

Route::get('init-data-paciente', [
    App\Http\Controllers\Common\CasoController::class, 'initDataPaciente'
]);

Route::post('cases', [
    App\Http\Controllers\Common\CasoController::class, 'gestionCaso'
]);

Route::get('cases/{id}', [
    App\Http\Controllers\Common\CasoController::class, 'casoById'
]);

Route::get('motivo-especifico/{id}', [
    App\Http\Controllers\Common\CasoController::class, 'motivoEspecificoById'
]);

Route::get('search-paciente', [
    App\Http\Controllers\Common\CasoController::class, 'searchPaciente'
]);

Route::get('paciente/{id}', [
    App\Http\Controllers\Common\CasoController::class, 'pacienteById'
]);

Route::get(
    'municipios/{idDepartamento}',
    [
        App\Http\Controllers\Common\LocationController::class,
        'getMunicipiosByDepartamento'
    ]
);

Route::get(
    'veredas/{idMunicipio}',
    [
        App\Http\Controllers\Common\LocationController::class,
        'getVeredasByMunicipio'
    ]
);

Route::middleware([])->group(function () {

    Route::get('show-case/{id}', [App\Http\Controllers\Common\CasoController::class, 'show']);
    Route::get('casos', [App\Http\Controllers\Common\CasoController::class, 'getAll']);

    Route::put('update_profile', [App\Http\Controllers\Common\UserController::class, 'updateProfile']);

    Route::prefix('psicologo')->group(function () {
        Route::get('anuncios', [App\Http\Controllers\Psicologo\AnuncioController::class, 'getAll']);

        Route::get('statics', [
            App\Http\Controllers\Psicologo\CasoController::class,
            'getStatics'
        ]);
    });

    Route::prefix('admin')->group(function () {
        Route::apiResource('anuncios', App\Http\Controllers\Admin\AnuncioController::class);
        Route::apiResource('users', App\Http\Controllers\Admin\UserController::class);
        Route::put('users/toggle_status/{id}', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus']);
        Route::get('administradores', [App\Http\Controllers\Admin\UserController::class, 'getAdministradores']);
        Route::get('psicologos', [App\Http\Controllers\Admin\UserController::class, 'getPsicologos']);
    });
});
