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
//------------------------------------------------------------------------------------
//Tela gestor tela21 listadealunos
Route::get('/listar_alunos',[
	'as'=>'listar_alunos',
	'uses'=>'ProfessorController@listar_alunos'
]);
//------------------------------------------------------------------------------------
//Tela gestor tela22 precadastro aluno
Route::get('/listar_alunos/pre_cadastro_aluno', [
	'as'=>'listar_alunos.pre_cadastro_alunos',
	'uses'=>'ProfessorController@pre_cadastro_aluno'
]);

Route::post('/salvar_pre_cadastro_aluno', [
	'as'=>'salvar_pre_cadastro_aluno',
	'uses'=>'ProfessorController@salvar_pre_cadastro_aluno'
]);
//------------------------------------------------------------------------------------
//Tela aluno tela2 cadastro aluno
Route::get('/cadastrar_aluno',[
   'as' => 'cadastrar_aluno',
    'uses'=> 'AlunoController@cadastro_aluno'
]);
Route::post('/salvar_cadastro_aluno', [
    'as' => 'salvar_cadastro_aluno',
    'uses' => 'AlunoController@salvar_cadastro_aluno'
]);
Route::get('/perfil_aluno',[
    'as' => 'perfil_aluno',
    'uses' => 'AlunoController@perfil_aluno'
]);
//------------------------------------------------------------------------------------
//Tela gestor tela19 listaprofessorescadastrados
Route::get('/listar_professores',[
    'as'=>'listar_professores',
    'uses'=>'ProfessorController@listar_professores'
]);
//------------------------------------------------------------------------------------
//Tela gestor tela29 precadastroprofessor
Route::get('/listar_professores/pre_cadastro_professor', [
    'as'=>'listar_professores.pre_cadastro_professor',
    'uses'=>'ProfessorController@pre_cadastro_professor'
]);

Route::post('/salvar_pre_cadastro_professor', [
    'as'=>'salvar_pre_cadastro_professor',
    'uses'=>'ProfessorController@salvar_pre_cadastro_professor'
]);
//------------------------------------------------------------------------------------
//Tela gestor tela25 definicaodocronograma
Route::get('/cadastrar_cronograma/', [
    'as' => 'cadastrar_cronograma.cadastro_cronograma', //apelido da rota
    'uses' => 'CronogramaController@cadastro',
]);

Route::post('salvar_atividade_cronograma',[
    'as' => 'salvar_atividade_cronograma',
    'uses' => 'CronogramaController@salvar_atividade_cronograma'
]);

Route::get('/cadastrar_cronograma/', [
   'as' => 'listar_atividades_cronograma',
   'uses' => 'CronogramaController@listar_atividades_cronograma'
]);

Route::post('excluir_atividade_cronograma', [
    'as' => 'cadastrar_cronograma.deletar_atividade_cronograma',
    'uses' => 'CronogramaController@deletar_atividade_cronograma'
]);
//------------------------------------------------------------------------------------
//Tela aluno tela6 cronograma
Route::get( '/perfil_aluno/visualizar_cronograma', [
'as' => 'aluno_visualizar_cronograma',
   'uses' => 'CronogramaController@aluno_visualizar_cronograma'
]);

//Tela professor tela10 cronograma
Route::get('/perfil_professor/visualizar_cronograma', [
    'as' => 'professor_visualizar_cronograma',
    'uses' => 'CronogramaController@professor_visualizar_cronograma'
]);