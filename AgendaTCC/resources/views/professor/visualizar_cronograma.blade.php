@extends('layout')

@section('titulo','Cronograma')


@section('conteudo')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

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
    <h3><strong> TCC1 </strong></h3>
    <table style="width:100%" class="table table-hover">
        <tr>
            <th>Descrição</th>
            <th>Data Início</th>
            <th>Data Fim</th>
        </tr>
        @foreach($cronograma1 as $c)
            <tr>
                <td>{{$c->nome}}</td>
                @php
                    $data = $c->data_inicio;
                    $data = explode('-', $data);
                    $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                @endphp
                <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
                @php
                    $data = $c->data_fim;
                    $data = explode('-', $data);
                    $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                @endphp
                <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
            </tr>
        @endforeach
    </table>

    <h3><strong> TCC2 </strong></h3>
    <table style="width:100%" class="table table-hover">
        <tr>
            <th>Descrição</th>
            <th>Data Início</th>
            <th>Data Fim</th>
        </tr>
        @foreach($cronograma2 as $c)
            <tr>
                <td>{{$c->nome}}</td>
                @php
                    $data = $c->data_inicio;
                    $data = explode('-', $data);
                    $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                @endphp
                <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
                @php
                    $data = $c->data_fim;
                    $data = explode('-', $data);
                    $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                @endphp
                <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
            </tr>
        @endforeach
    </table>
    {{---------------------Fim Tabela------------------------}}
@endsection