@extends('layout')

@section('titulo','Cronograma')

{{--@section('camposnavbar')--}}
    {{--<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>--}}
{{--@endsection--}}

@section('conteudo')
    <form action="{{ route('salvar_atividade_cronograma') }}" method="post">
    {{ csrf_field() }}
        <div class='form-group' >
            <label>Nome</label>
            <input type='text' class='form-control' name='nome' required>
            <label>Data de Início</label>
            <input type='date' class='form-control' name='data_inicio' required>
            <label>Data de Fim</label>
            <input type='date' class='form-control' name='data_fim' required>
        </div>

        <label>Semestre</label>
        <select id="listbox_semestre", name="semestre">
            @foreach($cronogramas as $cronograma)
                <option>{{$cronograma->semestre_ano}}-{{ $cronograma->semestre_numero}}</option>
            @endforeach
        </select>
        <label>Turma</label>
        <select id="listbox_turma", name="turma">
            <option value="1">TCC 1</option>
            <option value="2">TCC 2</option>
        </select>
        <br>
        <input type='submit' class='btn btn-default' value='Cadastrar'>
    </form>
    {{-------------------Inicio Tabela-----------------------}}
    <br><br>
    <form action="{{ route('cadastrar_cronograma.deletar_atividade_cronograma')}}" method="post" }}">
    {{ csrf_field() }}
        <table style="width:100%">
            <tr>
                <th>Descrição</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Excluir Atividade</th>
            </tr>

            @foreach($atividades_cronograma as $atividade)
                <tr>
                    <td>{{$atividade->nome}}</td>
                    <td>{{$atividade->data_inicio}}</td>
                    <td>{{$atividade->data_fim}}</td>
                    {{--acrescentar campos semestre_ano, semestre_numero e turma de cronograma--}}
                    <td><button type='submit' class='btn btn-default' name="Excluir" value = '{{$atividade->id}}' href="{{ route('cadastrar_cronograma.deletar_atividade_cronograma', $atividade->id)}}">Excluir</td>
                </tr>
            @endforeach
        </table>
    </form>
    {{---------------------Fim Tabela------------------------}}
@endsection


