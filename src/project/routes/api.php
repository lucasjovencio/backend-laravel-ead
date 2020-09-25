<?php

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


Route::prefix('v1')->group(function(){
    Route::resource('users','Api\UserController');
    Route::resource('aulas','Api\AulaController');
    Route::resource('cursos','Api\CursoController');
    Route::resource('aula-cursos','Api\AulaCursoController');
    Route::resource('turmas','Api\TurmaController');
    Route::resource('user-turmas','Api\UserTurmaController');
});
