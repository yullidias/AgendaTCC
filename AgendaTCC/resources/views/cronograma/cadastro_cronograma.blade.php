@extends('layout')

@section('titulo','Cronograma')

{{--@section('camposnavbar')--}}
    {{--<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>--}}
{{--@endsection--}}

@section('conteudo')
    <form></form>
    <div class='form-group'>
        <label>Descrição</label>
        <input type='text' class='form-control' name='descricao'>
        <label>Data de Início</label>
        <input type='text' class='form-control' name='data_inicio'>
        <label>Data de Fim</label>
        <input type='text' class='form-control' name='data_fim'>
    </div>
    <input type='submit' class='btn btn-default' value='Enviar'>

    <p></p>

    <table style="width:100%">
        <tr>
            <th>Descrição</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Excluir Atividade</th>
        </tr>

        @foreach($atividades as $atividade)
            <tr>
                <td>{{$atividade->descricao}}</td>
                <td>{{$atividade->data_inicio}}</td>
                <td>{{$atividade->data_fim}}</td>
                <td><input type='submit' class='btn btn-default' value='Excluir'></td>
            </tr>
        @endforeach

    </table>
@endsection

