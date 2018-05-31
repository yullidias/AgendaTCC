@extends('layout')

@section('titulo','Alterar Aluno')

@section('voltar')
<a href="{{ route('listar_alunos') }}"><span class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection


@section('conteudo')


<div class='col-md-6 col-md-offset-1'>
    <form action="{{ route('listar_alunos.alterar_aluno.salvar_alterar_aluno') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Nome</label>
            <input type='text' class='form-control' name='nome' value="{{$aluno['nome']}}" {{is_null ($aluno['id'])? 'readonly':''}} ><br>

            <label>Matricula</label>
            <input type='text' class='form-control' name='id' value="{{$aluno['id']}}" {{is_null ($aluno['nome'])? 'readonly':''}} ><br>
 
            <label>E-mail</label>
            <input type='text' class='form-control' name='email' value="{{$aluno['email']}}" {{is_null ($aluno['email'])? 'readonly':''}}><br>
                    
            <label>Matéria</label>
             <div class="radio">
                <label>
                    <input type="radio" name="materia" value="1" {{ ($aluno['materia']==1) ? "checked": "" }}  > TCC1
                </label>
                &ensp;
                <label>
                    <input type="radio" name="materia" value="2" {{ ($aluno['materia']==2) ? "checked": " " }}  > TCC2
                </label>
            </div><br>
            
            <label>Orientador</label>
                <select class="form-control" name="orientador">
                    @foreach ($professores as $professor)
                    <option value="{{$professor->id}}" >{{$professor->nome}}</option>
                    @endforeach
                </select><br>

            <label>Coorientador</label>
            <input type='text' class='form-control' name='coorientador' value="{{$aluno['coorientador']}} " {{is_null ($aluno['coorientador'])? 'readonly':''}}><br>

            <label>Tema</label>
            <input type='text' class='form-control' name='tema' value="{{$aluno['tema']}}" {{is_null ($aluno['tema'])? 'readonly':''}}><br>

            <label>Membro da Banca 1</label>
            <input type='text' class='form-control' name='membro_banca_1' value="{{$aluno['membro_banca_1']}} " {{is_null ($aluno['membro_banca_1'])? 'readonly':''}}><br>

            <label>Membro da Banca 2</label>
            <input type='text' class='form-control' name='membro_banca_2' value="{{$aluno['membro_banca_2']}}" {{is_null ($aluno['membro_banca_2'])? 'readonly':''}}><br>
        </div>

        <br><input type='submit' class='btn btn-default' value='Cadastrar'>

    </form>
</div>
@endsection