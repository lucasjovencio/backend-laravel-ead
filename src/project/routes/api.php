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
    Route::get('users/select','Api\UserController@select');
    Route::resource('users','Api\UserController');
    Route::get('aulas/select','Api\AulaController@select');
    Route::resource('aulas','Api\AulaController');
    Route::resource('cursos','Api\CursoController');
    Route::resource('aula-cursos','Api\AulaCursoController');
    Route::get('aula-cursos/curso/{id}','Api\AulaCursoController@curso');
    Route::resource('turmas','Api\TurmaController');
    Route::resource('user-turmas','Api\UserTurmaController');
    Route::get('user-turmas/turma/{id}','Api\UserTurmaController@turma');

});
