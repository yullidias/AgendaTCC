@extends('layout')

@section('titulo','Cronograma')

{{--@section('camposnavbar')--}}
    {{--<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>--}}
{{--@endsection--}}

@section('conteudo')
    <form>
    {{ csrf_field() }}
    <div class='form-group' action="{{ route('salvar_atividade_cronograma.salvar') }}" method="post">
        <label>Nome</label>
        <input type='text' class='form-control' name='nome' required>
        <label>Data de Início</label>
        <input type='date' class='form-control' name='data_inicio' required>
        <label>Data de Fim</label>
        <input type='date' class='form-control' name='data_fim' required>
    </div>
    <input type='submit' class='btn btn-default' value='Enviar' href="{{ route('salvar_atividade_cronograma.salvar') }}">
    </form>
@endsection

@section('tabela')
    <br><br>
    <table style="width:100%">
        <tr>
            <th>Descrição</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Excluir Atividade</th>
        </tr>

        @foreach($registro as $atividade)
            <tr>
                <td>{{$atividade->nome}}</td>
                <td>{{$atividade->data_inicio}}</td>
                <td>{{$atividade->data_fim}}</td>
                {{--acrescentar campos semestre_ano, semestre_numero e turma de cronograma--}}
                <td><input type='submit' class='btn btn-default' value='Excluir' href="{{ route('cadastrar_cronograma.deletar_atividade_cronograma', $atividade->id) }}"></td>
            </tr>
        @endforeach

    </table>
@endsection

