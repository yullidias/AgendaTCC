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
    Route::get('/cadastrarAluno',[
        'as' => 'cadastrar_aluno',
        'uses'=> 'AlunoController@cadastro_aluno'
    ]);

    Route::post('/salvarCadastroAluno', [
        'as' => 'salvar_cadastro_aluno',
        'uses' => 'AlunoController@salvar_cadastro_aluno'
    ]);

    //Cadastro Professor
    Route::get('/cadastrarProfessor',[
        'as' => 'cadastrar_professor',
        'uses'=> 'ProfessorController@cadastro_professor'
    ]);

    Route::post('/salvarCadastroProfessor', [
        'as' => 'salvar_cadastro_professor',
        'uses' => 'ProfessorController@salvar_cadastro_professor'
    ]);

//--------------------------------------------------------------------------------------
//Grupo de acesso para o aluno
Route::group(['middleware'=>['auth','check.aluno']], function(){

    Route::get('/perfilAluno/',[
        'as' => 'perfil_aluno',
        'uses' => 'AlunoController@perfil_aluno'

    ]);
    Route::post('/perfilAluno/solicitarAlteracaoAluno',[
        'as' => 'solicitar_alteracao_aluno',
        'uses' => 'AlunoController@solicitar_alteracao'
    ]);

    Route::post('/perfilAluno/salvarSolicitacao', [
        'as' => 'salvar_solicitacao_alteracao',
        'uses' => 'AlunoController@salvar_solicitacao_alteracao'
    ]);

    //Tela aluno tela 6 cronograma
    Route::get( '/perfilAluno/visualizarCronograma', [
        'as' => 'aluno_visualizar_cronograma',
        'uses' => 'CronogramaController@aluno_visualizar_cronograma'
    ]);

    Route::get('/perfilAluno/submeterTCC/{id}',[
        'as' => 'submeter_tcc',
        'uses'=> 'AlunoController@submeter_tcc'
    ]);

    Route::post('/perfilAluno/salvarSubmeterTCC',[
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

   /* Route::get('/listar_alunos/pre_cadastro_aluno', [
        'as'=>'listar_alunos.pre_cadastro_alunos',
        'uses'=>'ProfessorController@pre_cadastro_aluno'
    ]);

    Route::post('/listar_alunos/pre_cadastro_aluno/salvar_pre_cadastro_aluno', [
        'as'=>'listar_alunos.pre_cadastro_alunos.salvar_pre_cadastro_aluno',
        'uses'=>'ProfessorController@salvar_pre_cadastro_aluno'
    ]);*/

});

//--------------------------------------------------------------------------------------------
//Grupo de acesso do professor
Route::group(['middleware'=>['auth','check.professor']], function (){
    //------------------------------------------------------------------------------------
        Route::get('/perfilProfessor/{id}',[
            'as' => 'perfil_professor',
            'uses' => 'ProfessorController@perfil_professor'
        ]);
        Route::post('/perfilProfessor/solicitarAlteracaoProfessor',[
            'as' => 'solicitar_alteracao_professor',
            'uses' => 'ProfessorController@solicitar_alteracao'
        ]);
    //------------------------------------------------------------------------------------
    //Tela professor tela 11 lista de alunos
        Route::get('/perfilProfessor/listaAlunos/{id}',[
            'as' => 'visualizar_lista_alunos',
            'uses' => 'ProfessorController@visualizar_lista_alunos'
        ]);
        Route::post('/perfilProfessor/listaAlunos/{id}',[
            'as' => 'visualizar_lista_alunos',
            'uses' => 'ProfessorController@visualizar_lista_alunos'
        ]);
        Route::get('/perfilProfessor/listaAlunos/visualizarAluno/{id}',[
            'as'=>'visualizar_aluno',
            'uses'=>'ProfessorController@professor_visualiza_aluno'
        ]);

        Route::get('/perfilProfessor/listaAlunos/avaliarAluno/{id}',[
            'as'=>'avaliar_aluno',
            'uses'=>'ProfessorController@avaliar_aluno'
        ]);

        Route::post('/perfilProfessor/listaAlunos/avaliarAluno/salvarAvaliacao', [
            'as' => 'salvar_avaliacao',
            'uses' => 'ProfessorController@salvar_avaliacao'
        ]);

        //Tela professor tela 10 visualizar cronograma
        Route::get('/perfilProfessor/visualizarCronograma', [
            'as' => 'professor_visualizar_cronograma',
            'uses' => 'CronogramaController@professor_visualizar_cronograma'
        ]);

        Route::get('/listarProfessores/preCadastroProfessor', [
            'as'=>'listar_professores.pre_cadastro_professor',
            'uses'=>'ProfessorController@pre_cadastro_professor'
        ]);

        Route::post('/listarProfessores/preCadastroProfessor/salvarPreCadastroProfessor', [
            'as'=>'listar_professores.pre_cadastro_professor.salvar_pre_cadastro_professor',
            'uses'=>'ProfessorController@salvar_pre_cadastro_professor'
        ]);
});

//Grupo de acesso do orientador
//------------------------------------------------------------------------------------
Route::group(['middleware'=>['auth','check.orientador']], function(){
    //Tela orientador tela 18 agendamento
    Route::post('/perfilOrientador/listarAlunos/salvarAgendamento/',[
        'as' => 'salvar_agendamento',
        'uses' => 'AgendamentoController@salvar_agendamento'
    ]);

    Route::get('/perfilOrientador/listarAlunos/verAgendamento/{id}', [
        'as' => 'ver_agendamento',
        'uses' => 'AgendamentoController@ver_agendamento'
    ]);

    Route::get('/perfilOrientador/listarAlunos/{id}',[
        'as' => 'visualizar_lista_alunos_orientador',
        'uses' => 'ProfessorController@visualizar_lista_alunos_orientador'
    ]);
    Route::post('/perfilOrientador/listarAlunos/{id}',[
        'as' => 'visualizar_lista_alunos_orientador',
        'uses' => 'ProfessorController@visualizar_lista_alunos_orientador'
    ]);

    //Tela professor tela 10 visualizar cronograma
    Route::get('/perfilOrientador/visualizarCronograma', [
        'as' => 'orientador_visualizar_cronograma',
        'uses' => 'CronogramaController@professor_visualizar_cronograma'
    ]);
});

//Acesso do Gestor
//------------------------------------------------------------------------------------
Route::group(['middleware'=>['auth','check.gestor']], function (){
    //Tela gestor tela21 listadealunos
        Route::get('perfilGestor/listarAlunos',[
            'as'=>'listar_alunos',
            'uses'=>'ProfessorController@listar_alunos'
        ]);

        Route::post('perfilGestor/listarAlunos',[
            'as'=>'listar_alunos',
            'uses'=>'ProfessorController@listar_alunos'
        ]);

    //------------------------------------------------------------------------------------
    //Tela gestor tela23 alteracaocadastroaluno
     //Tela gestor tela24 dadoscadastraisaluno
        Route::post('perfilGestor/listarAlunos/operacoesAluno',[
            'as'=>'listar_alunos.operacoes_aluno',
            'uses'=>'ProfessorController@operacoes_aluno'
        ]);

       Route::post('perfilGestor/listarAlunos/salvarAlteracaoAluno',[
            'as'=>'listar_alunos.alterar_aluno.salvar_alterar_aluno',
            'uses'=>'ProfessorController@salvar_alterar_aluno'
        ]);

    //------------------------------------------------------------------------------------
    //Tela gestor tela22 precadastro aluno
        Route::get('perfilGestor/listarAlunos/preCadastroAluno', [
            'as'=>'listar_alunos.pre_cadastro_alunos',
            'uses'=>'ProfessorController@pre_cadastro_aluno'
        ]);

        Route::post('perfilGestor/listarAlunos/salvarPreCadastroAluno', [
            'as'=>'listar_alunos.pre_cadastro_alunos.salvar_pre_cadastro_aluno',
            'uses'=>'ProfessorController@salvar_pre_cadastro_aluno'
        ]);
    //------------------------------------------------------------------------------------
    //Tela gestor tela19 listaprofessorescadastrados
        Route::get('perfilGestor/listarProfessores',[
            'as'=>'listar_professores',
            'uses'=>'ProfessorController@listar_professores'
        ]);
        Route::post('perfilGestor/listarProfessores',[
            'as'=>'listar_professores',
            'uses'=>'ProfessorController@listar_professores'
        ]);
     //------------------------------------------------------------------------------------
    //Tela gestor tela20 dadoscadastraisprofessor
        Route::get('perfilGestor/listarProfessores/visualizarProfessor/{id}',[
            'as'=>'listar_professores.visualizar_professor',
            'uses'=>'ProfessorController@visualizar_professor'
        ]);
     //------------------------------------------------------------------------------------
    //Tela gestor tela23 alteracaocadastroaluno
        Route::get('perfilGestor/listarProfessores/alterarProfessor/{id}',[
            'as'=>'listar_professores.alterar_professor',
            'uses'=>'ProfessorController@alterar_professor'
        ]);

        Route::post('perfilGestor/listarProfessores/salvarAlteracaoProfessor',[
            'as'=>'listar_professores.alterar_professor.salvar_alterar_professor',
            'uses'=>'ProfessorController@salvar_alterar_professor'
        ]);
       //------------------------------------------------------------------------------------
    //Tela gestor  excluir professor
        Route::get('perfilGestor/listarProfessores/excluirProfessor/{id}',[
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
        Route::post('perfilGestor/gerirCronograma/salvo',[
            'as' => 'salvar_atividade_cronograma',
            'uses' => 'CronogramaController@salvar_atividade_cronograma'
        ]);

        Route::post('perfilGestor/gerirCronograma/atualizado',[
            'as' => 'atualizar_atividade_cronograma',
            'uses' => 'CronogramaController@atualizar_atividade_cronograma'
        ]);

        Route::get('perfilGestor/gerirCronograma/', [
            'as' => 'listar_atividades_cronograma',
            'uses' => 'CronogramaController@listar_atividades_cronograma'
        ]);

        Route::post('perfilGestor/gerirCronograma/excluido', [
            'as' => 'excluir_atividade_cronograma',
            'uses' => 'CronogramaController@deletar_atividade_cronograma'
        ]);
        //------------------------------------------------------------------------
        //Tela gestor Gerir Semestres
        Route::get('perfilGestor/gerirSemestres/', [
            'as' => 'listar_semestres',
            'uses' => 'SemestreController@listar_semestres'
        ]);

        Route::post('perfilGestor/gerirSemestres/salvo',[
            'as' => 'salvar_semestre',
            'uses' => 'SemestreController@salvar_semestre'
        ]);

        Route::post('perfilGestor/gerirSemestres/atualizado', [
            'as' => 'atualizar_semestre',
            'uses' => 'SemestreController@atualizar_semestre'
        ]);

        Route::post('perfilGestor/excluirSemestres/excluido', [
            'as' => 'excluir_semestre',
            'uses' => 'SemestreController@excluir_semestre'
        ]);

        //Tela gestor tela26 gestaoSalas
        Route::get('perfilGestor/gerirSalas/',[
            'as' => 'listar_salas',
            'uses' => 'SalaController@listar_salas'
        ]);

        Route::post('perfilGestor/salvarSala',[
            'as' => 'salvar_sala',
            'uses' => 'SalaController@salvar_sala'
        ]);

        Route::post('perfilGestor/excluirSala',[
            'as' => 'excluir_sala',
            'uses' => 'SalaController@excluir_sala'
        ]);
});
