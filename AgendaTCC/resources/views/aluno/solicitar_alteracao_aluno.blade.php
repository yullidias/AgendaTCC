@extends('layout')

@section('titulo','Solicitar Alteração')

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


    <form action="{{ route('salvar_solicitacao_alteracao') }}" method="post">
        {{ csrf_field() }}
        <div class='form-group' >
            <label>{{$tipoSolicitacao}} Atual</label>
            <input type='text' class='form-control' name='atual' value='{{$valorAtual}}' readonly>
            <label>{{$tipoSolicitacao}} Novo</label>
            <input type='text' class='form-control' name='novo' required>
            <label>Justificativa</label>
            <textarea class="form-control" name='justificativa' style="height: 200px" required></textarea>
        </div>
        <br>
        <input type='submit' class='btn btn-primary' value='Enviar'>
    </form>
@endsection