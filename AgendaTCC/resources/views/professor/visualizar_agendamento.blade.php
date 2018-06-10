@extends('layout')

@section('titulo','Agendamento')

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

    @php
        if($agendamento){
            $array = explode(' ', $agendamento->data);
            $data = $array[0];
            $hora = $array[1];
            $predio = $agendamento->predio;
            $sala = $agendamento->sala;
            $membro1 = $agendamento->membro1;
            $membro2 = $agendamento->membro2;
        }
        else{
            $data = "";
            $horario = "";
            $predio = "";
            $sala = "";
            $membro1 = "";
            $membro2 = "";
        }
    @endphp

    <form action="{{ route('salvar_agendamento') }}" method="post">
        <div class='form-group' >
            {{ csrf_field() }}
            <table id="t1" style="width:100%">
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                </tr>
                <tr>
                    <td><input type='date' style="width:100%" class='form-control' name='data' required></td>
                    <td><input type='time' style="width:100%" class='form-control' name='horario' required></td>
                </tr>
            </table>
            <table id="t1" style="width:100%">
                <tr>
                    <th>Sala</th>
                </tr>
                <td><select class="form-control" value="" style="width:100%" name="sala" required>
                    @foreach($salas as $s)
                        <option>Prédio {{$s->predio}} - Sala {{$s->sala}}</option>
                    @endforeach
                </select></td>
            </table>
            <table id="t1" style="width:100%">
                <tr>
                    <th>Membro 1 da Banca</th>
                    <th>Membro 2 da Banca</th>
                </tr>
                <tr>
                    <td> <select class="form-control" style="width:100%" name="membro1" required>
                            @foreach($professores as $p)
                                <option>{{$p->nome}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td> <select class="form-control" style="width:100%" name="membro2" required>
                            @foreach($professores as $p)
                                <option>{{$p->nome}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>

        </div>
        <input type='submit' class='btn btn-success pull-right' name="matricula" value="Salvar" }>
    </form>
    {{-------------------Inicio Tabela-----------------------}}
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
    <table id='t2' style="width:100%" class="table table-hover">
        <tr>
            <th>Alteracoes</th>
        </tr>
        @foreach($logs as $l)
            <tr>
                <td>{{$s->alteracao}}</td>
            </tr>
        @endforeach
    </table>
    <br><br>

    {{---------------------Fim Tabela------------------------}}
@endsection