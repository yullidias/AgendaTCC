/*Schema::create('agendamentos', function (Blueprint $table) {
$table->dateTime('data');
$table->string('sala',10);
$table->string('predio',10);
$table->integer('id_matricula')->unsigned();
$table->string('membro1banca');
$table->string('membro2banca');
$table->primary(['data', 'sala', 'predio', 'id_matricula']);
});*/
/* Schema::create('log_agendamentos', function (Blueprint $table) {
$table->integer('id')->increment();
$table->integer('id_matricula')->unsigned();
$table->string('id_orientador',12);
$table->string('alteracao',75);
$table->timestamps();
});*/
/*//Grupo de acesso do orientador
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
});*/