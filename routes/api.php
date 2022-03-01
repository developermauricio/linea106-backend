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


Route::middleware(['auth:api'])->group(function () {

    Route::get('reportes-casos', [
        \App\Http\Controllers\Common\ReportController::class, 'getReporteCasos'
    ]);

    Route::get('reporte-conducta-suicida', [
        \App\Http\Controllers\Common\ReportController::class, 'getSuicidioReporte'
    ]);

    Route::get('reporte-menores', [
        \App\Http\Controllers\Common\ReportController::class, 'getMenoresReporte'
    ]);

    Route::group(['prefix' => 'mes'], function () {
        Route::get('psicologo', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesPsicologos'
        ]);

        Route::get('origen', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesOrigenes'
        ]);

        Route::get('tipo-paciente', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesTipoPacientes'
        ]);

        Route::get('turno', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesTurnos'
        ]);

        Route::get('edad', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesEdades'
        ]);

        Route::get('escolaridad', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesEscolaridades'
        ]);

        Route::get('sexo', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesSexos'
        ]);

        Route::get('zona', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesZonas'
        ]);

        Route::get('ocupacion', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesOcupaciones'
        ]);

        Route::get('genero', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesGeneros'
        ]);

        Route::get('ciudad', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesCiudades'
        ]);

        Route::get('motivo-especifico', [
            \App\Http\Controllers\Common\ReportController::class, 'getMesMotivosEspecificos'
        ]);

    });

    Route::get('get-motivos-consulta-reportes', [
        \App\Http\Controllers\Common\MotivoConsultaController::class, 'getMotivosConsultaReportes'
    ]);

    Route::get('/filter-data', [
        App\Http\Controllers\Common\CasoController::class,
        'getFilterData'
    ]);


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

    Route::get('get-seguimientos/{idCase}', [
        App\Http\Controllers\Common\SeguimientoController::class, 'getSeguimientosByCase'
    ]);

    Route::post('store-seguimiento', [
        App\Http\Controllers\Common\SeguimientoController::class, 'storeSeguimiento'
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

    Route::get('show-case/{id}', [App\Http\Controllers\Common\CasoController::class, 'show']);
    Route::get('casos', [App\Http\Controllers\Common\CasoController::class, 'getAll']);

    Route::put('update_profile', [App\Http\Controllers\Common\UserController::class, 'updateProfile']);

    Route::get('statics', [
        App\Http\Controllers\Common\StaticsController::class,
        'getStatics'
    ]);

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
