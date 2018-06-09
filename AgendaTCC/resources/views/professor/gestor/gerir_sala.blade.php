@extends('layout')

@section('titulo','Gestão de Salas')

@section('conteudo')

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->


    <form action="{{ route('salvar_sala') }}" method="post">
        {{ csrf_field() }}
        <div class='form-inline' >
            <label>Sala</label>
            <input type='text' class='form-control' name='sala' size="10" maxlength="15" required>
            <label>Prédio</label>
            <input type='text' class='form-control' name='predio' size="10"  maxlength="15"  required>
            <input type='submit' class='btn btn-success' value='Cadastrar'>
        </div>
    </form>
    {{-------------------Inicio Tabela-----------------------}}
    <style>
        table {
            table-layout: fixed;
            width: 100px;
        }

        th, td {
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #404040;
            color: white;
        }
    </style>

    <br><br>
    <form action="{{ route('excluir_sala')}}" method="post">
    {{ csrf_field() }}
    <table style="width:100%" class="table table-hover" role="button">
        <tr>
            <th>Sala</th>
            <th>Prédio</th>
            <th>Excluir</th>
        </tr>
        @foreach($salas as $sala)
            <tr>
                <td>{{$sala->sala}}</td>
                <td>{{$sala->predio}}</td>
                <td><button type='submit' class='btn btn-danger' name="Excluir"
                            value = '{{$sala->sala}}-{{$sala->predio}}'
                            href="{{ route('excluir_sala', $sala->sala, $sala->predio)}}"
                            role="button" onclick="return confirm('Sala {{$sala->sala}} e predio {{$sala->predio}} serão excluídos permanentemente!');">Excluir</td>
            </tr>
        @endforeach
    </table>
    </form>
    {{---------------------Fim Tabela------------------------}}
@endsection