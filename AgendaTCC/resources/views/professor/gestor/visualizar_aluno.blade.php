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
            <label>Nome</label>
            <input type='text' class='form-control' name='nome' value="{{$aluno->nome}}" readonly><br>

            <label>Matricula</label>
            <input type='text' class='form-control' name='id' value="{{$aluno->usuario_aluno}}" readonly><br>

            <label>E-mail</label>
            <input type='text' class='form-control' name='email' value="{{$aluno->email}}" readonly><br>

            <label>Matéria</label>
             <div class="radio">
                <label>
                    <input type="radio" name="materia" value="1" {{ ($aluno->materia==1) ? "checked": "disabled" }} > TCC1
                </label>
                &ensp;
                <label>
                    <input type="radio" name="materia" value="2" {{ ($aluno->materia==2) ? "checked": "disabled" }} > TCC2
                </label>
            </div><br>

            <label>Orientador</label>
            <input type='text' class='form-control' name='orientador' value="" readonly><br>

            <label>Coorientador</label>
            <input type='text' class='form-control' name='coorientador' value="" readonly><br>

            <label>Tema</label>
            <input type='text' class='form-control' name='tema' value="" readonly><br>

            <label>Membro Banca 1</label>
            <input type='text' class='form-control' name='membro_banca_1' value="" readonly><br>

            <label>Membro Banca 2</label>
            <input type='text' class='form-control' name='membro_banca_2' value="" readonly><br>
        </div>
    </form>
</div>
@endsection