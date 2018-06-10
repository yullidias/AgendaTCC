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
        table#t1 {
            table-layout: fixed;
            width: 100px;
        }
        table#t1 th, td {
            text-align: left;
            padding: 8px;
        }
        table#t1 th {
            color: black;
        }
    </style>


    {{ csrf_field() }}
    @if($show)
        <h3><strong>Defesa Agendada</strong></h3>
        <table id="t1" style="width:100%" class="table-condensed">
            @php
                if($agendamento){
                    $array = explode(' ', $agendamento->data);
                    $data = $array[0];
                    $hora = $array[1];
                    $sala = "Prédio ".$agendamento->predio." - Sala ".$agendamento->sala;
                    $membro1 = $agendamento->membro1;
                    $membro2 = $agendamento->membro2;
                }
                else{
                    $data = "";
                    $hora = "";
                    $sala = "";
                    $membro1 = "";
                    $membro2 = "";
                }
            @endphp
            <tr>
                <th>Data</th>
                <th>Horário</th>
            </tr>
            <tr>
                <td><input type="date" id="data" class='form-control' value="{{$data}}" width="10" disabled="disabled"></td>
                <td><input type="time" id="hora" class='form-control' value="{{$hora}}" width="10" disabled="disabled"></td>
            </tr>
        </table>
        <table id="t1" style="width:100%">
            <tr>
                <th>Sala</th>
            </tr>
            <tr>
                <td><input type="text" id="predio" class='form-control' value="{{$sala}}" width="10" disabled="disabled"></td>
            </tr>
        </table>
        <table id="t1" style="width:100%">
            <tr>
                <th>Membro 1 da Banca</th>
                <th>Membro 2 da Banca</th>
            </tr>
            <tr>
                <td><input type="text" id="membro1" class='form-control' value="{{$membro1}}" width="10" disabled="disabled"></td>
                <td><input type="text" id="membro2" class='form-control' value="{{$membro2}}" width="10" disabled="disabled"></td>
            </tr>
        </table>
        @if(!$agendamento)
            <label align="right">*Agendamento ainda não foi realizado.</label>
        @endif
        <br><br>
    @endif

    <style>
        table#t2 {
            table-layout: fixed;
            width: 100px;
        }
        table#t2 th, td {
            text-align: left;
            padding: 8px;
        }
        table#t2 th {
            background-color: #404040;
            color: white;
        }
    </style>

    {{ csrf_field() }}
    <h3><strong> TCC1 </strong></h3>
    <table id="t2" style="width:100%" class="table table-hover">
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
    <table id="t2" style="width:100%" class="table table-hover">
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