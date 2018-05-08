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
            @if(isset($aluno->nome))
                <label>Nome</label>
                <input type='text' class='form-control' name='nome' value="{{$aluno->nome}}"><br>
            @endif

            <label>Matricula</label>
            <input type='text' class='form-control' name='id' value="{{$aluno->usuario_aluno}}" readonly><br>

            @if(isset($aluno->email)) 
                <label>E-mail</label>
                <input type='text' class='form-control' name='email' value="{{$aluno->email}}"><br>
            @endif
                    
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
            
            @if(isset($aluno->orientador))
                <label>Orientador</label>
                <select class="form-control" name="orientador">
                    @foreach ($professores as $professor)
                    <option value="{{$professor->id}}" >{{$professor->nome}}</option>
                    @endforeach
                </select><br>
            @endif

            @if(isset($aluno->coorientador))
                <label>Coorientador</label>
                <select class="form-control" name="coorientador">
                    @foreach ($professores as $professor)
                    <option value="{{$professor->id}}">{{$professor->nome}}</option>
                    @endforeach
                </select><br>
            @endif

            @if(isset($aluno->tema))
                <label>Tema</label>
                <input type='text' class='form-control' name='tema' value="{{$aluno->tema}}"><br>
            @endif

            @if(isset($aluno->membro_banca_1))
                <label>Membro da Banca 1</label>
                <input type='text' class='form-control' name='membro_banca_1' value="{{$aluno->membro_banca_1}}"><br>
            @endif

            @if(isset($aluno->membro_banca_2))
                <label>Membro da Banca 2</label>
                <input type='text' class='form-control' name='membro_banca_2' value="{{$aluno->membro_banca_2}}"><br>
            @endif
        </div>

        <br><input type='submit' class='btn btn-default' value='Cadastrar'>

    </form>
</div>
@endsection