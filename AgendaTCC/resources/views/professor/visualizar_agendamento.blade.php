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
            $horario = $array[1];
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

    <form action="{{ route('salvar_agendamento',['id' => $id]) }}" method="post">
        <div class='form-group' >
            {{ csrf_field() }}
            <table id="t1" style="width:100%">
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                </tr>
                <tr>
                    <td><input type='date' style="width:100%" value="{{$data}}" class='form-control' name='data' required></td>
                    <td><input type='time' style="width:100%" value="{{$horario}}" class='form-control' name='horario' required></td>
                </tr>
            </table>
            <table id="t1" style="width:100%">
                <tr>
                    <th>Sala</th>
                </tr>
                <td><select class="form-control" value="Prédio {{$predio}} - Sala {{$sala}}" style="width:100%" name="sala" required>
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
                    <td> <select class="form-control" style="width:100%" value="{{$membro1}}" name="membro1" required>
                            @foreach($professores as $p)
                                <option>{{$p->nome}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td> <select class="form-control" style="width:100%" value="{{$membro2}}" name="membro2" required>
                            @foreach($professores as $p)
                                <option>{{$p->nome}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>

        </div>
        <input type='submit' class='btn btn-success pull-right' onclick="return confirm('Salvar alterações?');" value="Salvar" }>
    </form>
    {{-------------------Inicio Tabela-----------------------}}
    <style>
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

    <br></br>
    <table id='t2' style="width:100%" class="table table-hover">
        <tr>
            <th>Log de Alterações</th>
            <th> </th>
        </tr>
        @php($flag = false)
        @foreach($logs as $l)
            <tr>
                <td>{{$l->alteracao}}</td>
                <td>{{$l->created_at}}</td>
                @php($flag = true)
            </tr>
        @endforeach
        @if(!$flag)
            <td>Nenhuma alteração: Agendamento ainda não foi realizado.</td>
        @endif
    </table>
    <br><br>
    <label>*O sistema não se responsabiliza por eventuais indisponibilidades de salas e conflitos nos horários de agendamento, uma vez que os conflitos identificáveis são baseados nos agendamentos realizados no sistema e que não há integração com o sistema de agendamento de salas do CEFET.</label>
    <br><br>
    {{---------------------Fim Tabela------------------------}}
@endsection