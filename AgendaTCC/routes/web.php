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
Route::post('/solicitar_alteracao_aluno',[
    'as' => 'solicitar_alteracao_aluno',
    'uses' => 'AlunoController@solicitar_alteracao'
]);
//------------------------------------------------------------------------------------
//Tela professor cadastro professor
Route::get('/cadastrar_professor',[
   'as' => 'cadastrar_professor',
    'uses'=> 'ProfessorController@cadastro_professor'
]);
Route::post('/salvar_cadastro_professor', [
    'as' => 'salvar_cadastro_professor',
    'uses' => 'ProfessorController@salvar_cadastro_professor'
]);
Route::get('/perfil_professor',[
    'as' => 'perfil_professor',
    'uses' => 'ProfessorController@perfil_professor'
]);
Route::post('/solicitar_alteracao_professor',[
    'as' => 'solicitar_alteracao_professor',
    'uses' => 'ProfessorController@solicitar_alteracao'
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
Route::get('/cadastrarCronograma/', [
    'as' => 'cadastrar_cronograma.cadastro_cronograma', //apelido da rota
    'uses' => 'CronogramaController@cadastro',
]);

Route::post('/salvarCronograma/',[
    'as' => 'salvar_atividade_cronograma',
    'uses' => 'CronogramaController@salvar_atividade_cronograma'
]);

Route::get('/gerirCronograma/', [
    'as' => 'listar_atividades_cronograma',
    'uses' => 'CronogramaController@listar_atividades_cronograma'
]);

Route::post('/excluirCronograma/', [
    'as' => 'cadastrar_cronograma.deletar_atividade_cronograma',
    'uses' => 'CronogramaController@deletar_atividade_cronograma'
]);
//------------------------------------------------------------------------------------
//Tela aluno tela6 cronograma
Route::get( '/perfilAluno/visualizarCronograma', [
   'as' => 'aluno_visualizar_cronograma',
   'uses' => 'CronogramaController@aluno_visualizar_cronograma'
]);

//Tela professor tela10 cronograma
Route::get('/perfilProfessor/visualizarCronograma', [
    'as' => 'professor_visualizar_cronograma',
    'uses' => 'CronogramaController@professor_visualizar_cronograma'
]);
//------------------------------------------------------------------------------------
//Tela professor tela 11 lista de alunos
Route::get('/perfilProfessor/listaAlunos',[
   'as' => 'visualizar_lista_alunos',
   'uses' => 'ProfessorController@visualizar_lista_alunos'
]);
Route::post('/perfilProfessor/listaAlunos/visualiza_avalia_aluno', [
    'as' => 'visualiza_ou_avalia_aluno',
    'uses' => 'ProfessorController@visualiza_ou_avalia_aluno'
]);

//------------------------------------------------------------------------------------
//Tela Gerir Semestres
Route::post('/salvarSemestre/',[
    'as' => 'salvar_semestre',
    'uses' => 'SemestreController@salvar_semestre'
]);

Route::get('/gerirSemestres/', [
    'as' => 'gerir_semestres',
    'uses' => 'SemestreController@listar_semestres'
]);

Route::post('/excluirSemestre/', [
    'as' => 'excluir_semestre',
    'uses' => 'SemestreController@excluir_semestre'
]);