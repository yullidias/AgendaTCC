<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Tela gestor tela21 listadealunos
Route::get('/listar_alunos',[
	'as'=>'listar_alunos',
	'uses'=>'ProfessorController@listar_alunos'
]);

//Tela gestor tela22 precadastro aluno
Route::get('/listar_alunos/pre_cadastro_aluno', [
	'as'=>'listar_alunos.pre_cadastro_alunos',
	'uses'=>'ProfessorController@pre_cadastro_aluno'
]);

Route::post('/salvar_pre_cadastro_aluno', [
	'as'=>'salvar_pre_cadastro_aluno',
	'uses'=>'ProfessorController@salvar_pre_cadastro_aluno'
]);
