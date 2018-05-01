@extends('layout')

@section('titulo','Cronograma')

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
    </div> <!-- end .flash-message -->


    <form action="{{ route('salvar_atividade_cronograma') }}" method="post">
    {{ csrf_field() }}
        <div class='form-group' >
            <label>Nome</label>
            <input type='text' class='form-control' name='nome' required>
            <label>Data de Início</label>
            @php
               $semestre_ano = date ("Y"); //retorna o ano atual, no formato yyyy//
               $semestre_numero = (date ("m") <= 6)? 1 : 2;//retorna o numero do mes atual, descobre o semestre atual//
               $mes = ($semestre_numero==1)? 01 : 07;

               $min = $semestre_ano.$mes."-01-";
               $max = $semestre_ano.($mes+05)."-31-";
            @endphp
            <input type='date' class='form-control' name='data_inicio' required min="$min" max="$max">
            <label>Data de Fim</label>
            <input type='date' class='form-control' name='data_fim' required min="$min" max="$max">
        </div>

        <label>Semestre: </label>
            <h10>{{$semestre_ano.'-'.$semestre_numero}}</h10>

        <label>Turma</label>
        <select id="listbox_turma", name="turma">
            <option value="1">TCC 1</option>
            <option value="2">TCC 2</option>
        </select>
        <br>
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
    <form action="{{ route('cadastrar_cronograma.deletar_atividade_cronograma')}}" method="post" }}">
    {{ csrf_field() }}
        <table style="width:100%" class="table table-hover">
            <tr>
                <th>Descrição</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Semestre</th>
                <th>Turma</th>
                <th>Excluir Atividade</th>
            </tr>

            @foreach($cronogramas as $c)
                <tr>
                    <td>{{$c->nome}}</td>
                    @php
                        $data = $c->data_inicio;
                        $data = explode('-', $data);
                        $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                    @endphp
                    <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
                    @php
                        $data = $c->data_inicio;
                        $data = explode('-', $data);
                        $ano = $data[0]; $mes = $data[1]; $dia = $data[2];
                    @endphp
                    <td>{{$dia}}/{{$mes}}/{{$ano}}</td>
                    <td>{{$c->semestre_ano}}-{{$c->semestre_numero}}</td>
                    <td>TCC {{$c->turma}}</td>
                    {{--acrescentar campos semestre_ano, semestre_numero e turma de cronograma--}}
                    <td><button type='submit' class='btn btn-default' name="Excluir" value = '{{$c->id}}' href="{{ route('cadastrar_cronograma.deletar_atividade_cronograma', $c->id)}}">Excluir</td>
                </tr>
            @endforeach
        </table>
    </form>
    {{---------------------Fim Tabela------------------------}}
@endsection


