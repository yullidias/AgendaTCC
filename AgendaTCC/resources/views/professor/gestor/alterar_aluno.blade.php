@extends('layout')

@section('titulo','Alterar Aluno')

@section('voltar')
<a href="{{ route('listar_alunos') }}"><spa class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection


@section('conteudo')


<div class='col-md-6 col-md-offset-1'>
    <form action="{{ route('listar_alunos.alterar_aluno.salvar_alterar_aluno') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Nome</label>
            <input type='text' class='form-control' name='nome' value="{{$aluno->nome}}"><br>

            <label>Matricula</label>
            <input type='text' class='form-control' name='id' value="{{$aluno->usuario_aluno}}" readonly><br>

            <label>E-mail</label>
            <input type='text' class='form-control' name='email' value="{{$aluno->email}}"><br>

            <label>Matéria</label>
             <div class="radio">
                <label>
                    <input type="radio" name="materia" value="1" {{ ($aluno->materia==1) ? "checked": " " }}  > TCC1
                </label>
                &ensp;
                <label>
                    <input type="radio" name="materia" value="2" {{ ($aluno->materia==2) ? "checked": " " }}  > TCC2
                </label>
            </div><br>

            <label>Orientador</label>
            <input type='text' class='form-control' name='orientador' value=""><br>

            <label>Coorientador</label>
            <input type='text' class='form-control' name='coorientador' value=""><br>

            <label>Tema</label>
            <input type='text' class='form-control' name='tema' value=""><br>

            <label>Membro Banca 1</label>
            <input type='text' class='form-control' name='membro_banca_1' value=""><br>

            <label>Membro Banca 2</label>
            <input type='text' class='form-control' name='membro_banca_2' value=""><br>
        </div>

        <br><input type='submit' class='btn btn-default' value='Cadastrar'>

    </form>
</div>
@endsection