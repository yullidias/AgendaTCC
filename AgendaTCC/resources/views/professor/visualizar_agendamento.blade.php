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

@extends('layout')

@section('titulo','Semestre')

{{--@section('camposnavbar')--}}
{{--<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>--}}
{{--@endsection--}}

@section('conteudo')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>

    <form action="{{ route('salvar_semestre') }}" method="post">
        {{ csrf_field() }}
        <div class='form-group' >
            <label>Ano</label>
            <input type='number' class='form-control' name='ano' required>
            <label>Numero</label>
            <input type='number' class='form-control' name='numero' required>
            <label>Data de Início</label>
            <input type='date' class='form-control' name='data_inicio' required>
            <label>Data de Fim</label>
            <input type='date' class='form-control' name='data_fim' required>
        </div>

        <input type='submit' class='btn btn-default' value='Cadastrar'>
    </form>
    {{-------------------Inicio Tabela-----------------------}}
    <style>
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #404040;
            color: white;
        }
    </style>

    <br><br>

    {{ csrf_field() }}
    <table style="width:100%" class="table table-hover">
        <tr>
            <th>Ano</th>
            <th>Numero</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Salvar</th>
            <th>Excluir</th>
        </tr>
        @foreach($semestres as $s)
            <tr>
                <td>{{$s->ano}}</td>
                <td>{{$s->numero}}</td>
                @php $id= $s->ano."-".$s->numero; @endphp

                <form action="{{ route('atualizar_semestre')}}" method="post" }}">
                <td><input type='date' class='form-control' name='data_inicio' value="{{$s->data_inicio}}" width="10" required></td>
                <td><input type='date' class='form-control' name='data_fim' value="{{$s->data_fim}}" width="10" required></td>
                <td><button type='submit' class='btn btn-default' onclick="return confirm('Salvar alterações?');" name="id" value = '{{$id}}' > Salvar </td>
                </form>

                <form action="{{ route('excluir_semestre')}}" method="post" }}">
                <td><button type='submit' class='btn btn-default' onclick="return confirm('Tem certeza que deseja excluir?');" name="id" value = '{{$id}}' > Excluir </td>
                </form>
            </tr>
        @endforeach
    </table>
    {{---------------------Fim Tabela------------------------}}
@endsection