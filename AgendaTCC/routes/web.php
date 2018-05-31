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
    //Tela 1 Login
    Route::get('/',[
        'as'=>'site.login',
        'uses'=>'Site\LoginController@index'
    ]);
    Route::get('/login/sair',[
        'as'=>'site.login.sair',
        'uses'=>'Site\LoginController@sair'
    ]);
    Route::post('/login/entrar',[
        'as'=>'site.login.entrar',
        'uses'=>'Site\LoginController@entrar'
    ]);

    //Telas de cadastro para usuários não logados
    //Cadastro aluno
    Route::get('/cadastrar_aluno',[
        'as' => 'cadastrar_aluno',
        'uses'=> 'AlunoController@cadastro_aluno'
    ]);

    //Cadastro Professor
    Route::get('/cadastrar_professor',[
        'as' => 'cadastrar_professor',
        'uses'=> 'ProfessorController@cadastro_professor'
    ]);

Route::post('/salvar_cadastro_aluno', [
    'as' => 'salvar_cadastro_aluno',
    'uses' => 'AlunoController@salvar_cadastro_aluno'
]);
Route::post('/salvar_cadastro_professor', [
    'as' => 'salvar_cadastro_professor',
    'uses' => 'ProfessorController@salvar_cadastro_professor'
]);


//--------------------------------------------------------------------------------------
//Grupo de acesso para o aluno
Route::group(['middleware'=>['auth','check.aluno']], function(){


    Route::get('/perfil_aluno/{id}',[
        'as' => 'perfil_aluno',
        'uses' => 'AlunoController@perfil_aluno'

    ]);
    Route::post('/solicitar_alteracao_aluno',[
        'as' => 'solicitar_alteracao_aluno',
        'uses' => 'AlunoController@solicitar_alteracao'
    ]);

    //Tela aluno tela 6 cronograma
    Route::get( '/perfilAluno/visualizarCronograma', [
        'as' => 'aluno_visualizar_cronograma',
        'uses' => 'CronogramaController@aluno_visualizar_cronograma'
    ]);
    Route::get('/submeter_tcc',[
        'as' => 'submeter_tcc',
        'uses'=> 'AlunoController@submeter_tcc'
    ]);
    Route::post('/salvar_submeter_tcc',[
        'as' => 'salvar_submeter_tcc',
        'uses'=> 'AlunoController@salvar_submeter_tcc'
    ]);
    Route::get( '/download/{filename}', [
        'as'=>'download',
        'uses'=>'AlunoController@download'
    ]);
     Route::get( '/perfilAluno/visualizarNotas', [
        'as'=>'visualizarNotas',
        'uses'=>'AlunoController@visualizarNotas'
    ]);
    Route::get('/listar_alunos/pre_cadastro_aluno', [
        'as'=>'listar_alunos.pre_cadastro_alunos',
        'uses'=>'ProfessorController@pre_cadastro_aluno'
    ]);

    Route::post('/listar_alunos/pre_cadastro_aluno/salvar_pre_cadastro_aluno', [
        'as'=>'listar_alunos.pre_cadastro_alunos.salvar_pre_cadastro_aluno',
        'uses'=>'ProfessorController@salvar_pre_cadastro_aluno'
    ]);
    
    

});



//--------------------------------------------------------------------------------------------
//Grupo de acesso do professor
Route::group(['middleware'=>['auth','check.professor']], function (){
    //------------------------------------------------------------------------------------
        Route::get('/perfil_professor/{id}',[
            'as' => 'perfil_professor',
            'uses' => 'ProfessorController@perfil_professor'
        ]);
        Route::post('/solicitar_alteracao_professor',[
            'as' => 'solicitar_alteracao_professor',
            'uses' => 'ProfessorController@solicitar_alteracao'
        ]);
    //------------------------------------------------------------------------------------
    //Tela professor tela 11 lista de alunos
        Route::get('/perfilProfessor/listaAlunos',[
            'as' => 'visualizar_lista_alunos',
            'uses' => 'ProfessorController@visualizar_lista_alunos'
        ]);
        Route::post('/perfilProfessor/listaAlunos',[
            'as' => 'visualizar_lista_alunos',
            'uses' => 'ProfessorController@visualizar_lista_alunos'
        ]);
        Route::get('/perfilProfessor/listaAlunos/visualizar_aluno/{id}',[
            'as'=>'visualizar_aluno',
            'uses'=>'ProfessorController@professor_visualiza_aluno'
        ]);

        Route::get('/perfilProfessor/listaAlunos/avaliar_aluno/{id}',[
            'as'=>'avaliar_aluno',
            'uses'=>'ProfessorController@avaliar_aluno'
        ]);

        Route::post('/perfilProfessor/listaAlunos/avaliar_aluno/salvar_avaliacao', [
            'as' => 'salvar_avaliacao',
            'uses' => 'ProfessorController@salvar_avaliacao'
        ]);

    //Tela professor tela 10 cronograma
        Route::get('/perfilProfessor/visualizarCronograma', [
            'as' => 'professor_visualizar_cronograma',
            'uses' => 'CronogramaController@professor_visualizar_cronograma'
        ]);
        Route::get('/listar_professores/pre_cadastro_professor', [
            'as'=>'listar_professores.pre_cadastro_professor',
            'uses'=>'ProfessorController@pre_cadastro_professor'
        ]);

        Route::post('/listar_professores/pre_cadastro_professor/salvar_pre_cadastro_professor', [
            'as'=>'listar_professores.pre_cadastro_professor.salvar_pre_cadastro_professor',
            'uses'=>'ProfessorController@salvar_pre_cadastro_professor'
        ]);
});

//Grupo de acesso do orientador
Route::group(['middleware'=>['auth','check.orientador']], function(){
    //Tela orientador tela 18 agendamento
    Route::post('/salvarAgendamento/',[
        'as' => 'salvar_agendamento',
        'uses' => 'AgendamentoController@salvar_agendamento'
    ]);

    Route::post('/listarAgendamento/', [
        'as' => 'listar_agendamento_logs',
        'uses' => 'AgendamentoController@listar_agendamento_logs'
    ]);
});

//Acesso do Gestor
//------------------------------------------------------------------------------------
Route::group(['middleware'=>['auth','check.gestor']], function (){
    //Tela gestor tela21 listadealunos
        Route::get('/listar_alunos',[
            'as'=>'listar_alunos',
            'uses'=>'ProfessorController@listar_alunos'
        ]);

        Route::post('/listar_alunos',[
            'as'=>'listar_alunos',
            'uses'=>'ProfessorController@listar_alunos'
        ]);

    //------------------------------------------------------------------------------------
    //Tela gestor tela23 alteracaocadastroaluno
     //Tela gestor tela24 dadoscadastraisaluno
        Route::post('/listar_alunos.operacoes_aluno',[
            'as'=>'listar_alunos.operacoes_aluno',
            'uses'=>'ProfessorController@operacoes_aluno'
        ]);

       Route::post('/listar_alunos/alterar_aluno/salvar_alterar_aluno',[
            'as'=>'listar_alunos.alterar_aluno.salvar_alterar_aluno',
            'uses'=>'ProfessorController@salvar_alterar_aluno'
        ]);

    //------------------------------------------------------------------------------------
    //Tela gestor tela22 precadastro aluno
        /*Route::get('/listar_alunos/pre_cadastro_aluno', [
            'as'=>'listar_alunos.pre_cadastro_alunos',
            'uses'=>'ProfessorController@pre_cadastro_aluno'
        ]);

        Route::post('/listar_alunos/pre_cadastro_aluno/salvar_pre_cadastro_aluno', [
            'as'=>'listar_alunos.pre_cadastro_alunos.salvar_pre_cadastro_aluno',
            'uses'=>'ProfessorController@salvar_pre_cadastro_aluno'
        ]);*/
    //------------------------------------------------------------------------------------
    //Tela gestor tela19 listaprofessorescadastrados
        Route::get('/listar_professores',[
            'as'=>'listar_professores',
            'uses'=>'ProfessorController@listar_professores'
        ]);
        Route::post('/listar_professores',[
            'as'=>'listar_professores',
            'uses'=>'ProfessorController@listar_professores'
        ]);
     //------------------------------------------------------------------------------------
    //Tela gestor tela20 dadoscadastraisprofessor
        Route::get('/listar_professores/visualizar_professor/{id}',[
            'as'=>'listar_professores.visualizar_professor',
            'uses'=>'ProfessorController@visualizar_professor'
        ]);
     //------------------------------------------------------------------------------------
    //Tela gestor tela23 alteracaocadastroaluno
        Route::get('/listar_professores/alterar_professor/{id}',[
            'as'=>'listar_professores.alterar_professor',
            'uses'=>'ProfessorController@alterar_professor'
        ]);

        Route::post('/listar_professores/alterar_professor/salvar_alterar_professor',[
            'as'=>'listar_professores.alterar_professor.salvar_alterar_professor',
            'uses'=>'ProfessorController@salvar_alterar_professor'
        ]);
       //------------------------------------------------------------------------------------
    //Tela gestor  excluir professor
        Route::get('/listar_professores/excluir_professor/{id}',[
            'as'=>'listar_professores.excluir_professor',
            'uses'=>'ProfessorController@excluir_professor'
        ]);

    //------------------------------------------------------------------------------------
    //Tela gestor tela29 precadastroprofessor
       /* Route::get('/listar_professores/pre_cadastro_professor', [
            'as'=>'listar_professores.pre_cadastro_professor',
            'uses'=>'ProfessorController@pre_cadastro_professor'
        ]);

        Route::post('/listar_professores/pre_cadastro_professor/salvar_pre_cadastro_professor', [
            'as'=>'listar_professores.pre_cadastro_professor.salvar_pre_cadastro_professor',
            'uses'=>'ProfessorController@salvar_pre_cadastro_professor'
        ]);*/
    //------------------------------------------------------------------------------------
    //Tela gestor tela25 definicaodocronograma
        Route::post('/gerirCronograma/salvo',[
            'as' => 'cronograma.salvar_atividade_cronograma',
            'uses' => 'CronogramaController@salvar_atividade_cronograma'
        ]);

        Route::post('/gerirCronograma/atualizado',[
            'as' => 'cronograma.atualizar_atividade_cronograma',
            'uses' => 'CronogramaController@atualizar_atividade_cronograma'
        ]);

        Route::get('/gerirCronograma/', [
            'as' => 'cronograma.listar_atividades_cronograma',
            'uses' => 'CronogramaController@listar_atividades_cronograma'
        ]);

        Route::post('/gerirCronograma/excluido', [
            'as' => 'cronograma.deletar_atividade_cronograma',
            'uses' => 'CronogramaController@deletar_atividade_cronograma'
        ]);
        //------------------------------------------------------------------------
        //Tela gestor Gerir Semestres
        Route::get('/gerirSemestres/', [
            'as' => 'gerir_semestres',
            'uses' => 'SemestreController@listar_semestres'
        ]);

        Route::post('/gerirSemestres/salvo',[
            'as' => 'salvar_semestre',
            'uses' => 'SemestreController@salvar_semestre'
        ]);

        Route::post('/gerirSemestres/atualizado', [
            'as' => 'atualizar_semestre',
            'uses' => 'SemestreController@atualizar_semestre'
        ]);

        Route::post('/excluirSemestres/excluido', [
            'as' => 'excluir_semestre',
            'uses' => 'SemestreController@excluir_semestre'
        ]);

        //Tela gestor tela26 gestaoSalas
        Route::get('/gerirSalas',[
            'as' => 'listar_salas',
            'uses' => 'SalaController@listar_salas'
        ]);

        Route::post('/salvarSala',[
            'as' => 'salvar_sala',
            'uses' => 'SalaController@salvar_sala'
        ]);

        Route::post('/excluirSala',[
            'as' => 'excluir_sala',
            'uses' => 'SalaController@excluir_sala'
        ]);
});
