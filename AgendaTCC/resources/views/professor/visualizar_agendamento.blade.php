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
        table#t3 {
            table-layout: fixed;
            width: 100px;
        }
        table#t3 th, td {
            text-align: left;
            padding: 8px;
        }
        table#t3 th {

        }
    </style>

    <form action="{{ route('salvar_agendamento') }}" method="post">
        <div class='form-group' >
            {{ csrf_field() }}
            <table id="t3" style="width:100%">
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                </tr>
                <tr>
                    <td><input type='date' style="width:100%" class='form-control' name='data' required></td>
                    <td><input type='time' style="width:100%" class='form-control' name='horario' required></td>
                </tr>
            </table>

            <label for="sala">Sala</label>
            <select class="form-control" style="width:100%" name="sala" required>
                @foreach($salas as $s)
                    <option>Prédio {{$s->predio}} - Sala {{$s->sala}}</option>
                @endforeach
            </select>

            <br></br>

            <table id="t3" style="width:100%">
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

    {{---------------------Fim Tabela------------------------}}
@endsection