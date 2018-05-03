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
    <form action="{{ route('excluir_semestre')}}" method="post" }}">
    {{ csrf_field() }}
    <table style="width:100%" class="table table-hover">
        <tr>
            <th>Ano</th>
            <th>Numero</th>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Excluir Atividade</th>
        </tr>
        @foreach($semestres as $s)
            <tr>
                <td>{{$s->ano}}</td>
                <td>{{$s->numero}}</td>
                @php
                    $data = $s->data_inicio;
                    $data = explode('-', $data);
                    $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                @endphp
                <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
                @php
                    $data = $s->data_fim;
                    $data = explode('-', $data);
                    $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                @endphp
                <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
                @php
                    $value = $s->ano."-".$s->numero;
                @endphp
                <td><button type='submit' class='btn btn-default' name="Excluir" value = '{{$value}}' > Excluir </td>

            </tr>
        @endforeach
    </table>
    </form>
    {{---------------------Fim Tabela------------------------}}
    @endsection