@extends('layout')

@section('titulo','Visualizar Aluno')

@section('voltar')
<a href="{{ route('listar_alunos') }}"><spa class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection


@section('conteudo')


<div class='col-md-6 col-md-offset-1'>
    <form>
        {{ csrf_field() }}
        <div class="form-group">
            @if(isset($aluno->nome))
                <label>Nome</label>
                <input type='text' class='form-control' name='nome' value="{{$aluno->nome}}" readonly><br>
            @endif

            <label>Matricula</label>
            <input type='text' class='form-control' name='id' value="{{$aluno->usuario_aluno}}" readonly><br>

            @if(isset($aluno->email)) 
                <label>E-mail</label>
                <input type='text' class='form-control' name='email' value="{{$aluno->email}}" readonly><br>
            @endif
                    
            <label>Matéria</label>
             <div class="radio">
                <label>
                    <input type="radio" name="materia" value="1" {{ ($aluno->materia==1) ? "checked": "disabled" }}  > TCC1
                </label>
                &ensp;
                <label>
                    <input type="radio" name="materia" value="2" {{ ($aluno->materia==2) ? "checked": "disabled" }}  > TCC2
                </label>
            </div><br>
            
            @if(isset($aluno->orientador))
                <label>Orientador</label>
                <input type='text' class='form-control' name='orientador' value="{{$aluno->orientador}} " readonly><br>
            @endif

            @if(isset($aluno->coorientador))
                <label>Coorientador</label>
                <input type='text' class='form-control' name='coorientador' value="{{$aluno->coorientador}}" readonly><br>
            @endif

            @if(isset($aluno->tema))
                <label>Tema</label>
                <input type='text' class='form-control' name='tema' value="{{$aluno->tema}}" readonly><br>
            @endif

            @if(isset($aluno->membro_banca_1))
                <label>Membro da Banca 1</label>
                <input type='text' class='form-control' name='membro_banca_1' value="{{$aluno->membro_banca_1}} " readonly><br>
            @endif

            @if(isset($aluno->membro_banca_2))
                <label>Membro da Banca 2</label>
                <input type='text' class='form-control' name='membro_banca_2' value="{{$aluno->membro_banca_2}}" readonly><br>
            @endif
        </div>
    </form>
</div>
@endsection