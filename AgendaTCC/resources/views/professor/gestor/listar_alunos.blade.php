@extends('layout')

@section('conteudo')

@section('titulo','Listar Alunos')

<a class="btn btn-default pull-right" href="{{ route('listar_alunos.pre_cadastro_alunos') }}" role="button">Pré-cadastro aluno</a>
<div class='col-md-offset-1'>
    <br><br>
    <label>Matéria</label>
    <form action="{{ route('listar_alunos') }}" method="post">
        {{ csrf_field() }}
        <div class="radio">
          <label>
            <input type="radio" name="materia" onchange="this.form.submit()" value="1" {{ ($materia_selecionada==1) ? "checked": " " }}  > TCC1
          </label>
          &ensp;
          <label>
            <input type="radio" name="materia" onchange="this.form.submit()" value="2" {{ ($materia_selecionada==2) ? "checked": " " }}> TCC2
          </label>
        </div>


        <label>Semestre</label>
        <select class="form-control" style="width:100px" onchange="this.form.submit()" name="semestre"">
            @foreach($semestres as $semestre)
                {{ $valor = $semestre->numero.'-'.$semestre->ano }}
                <option value="{{$valor}}" {{ ($semestre_selecionado==$valor) ? "selected ": " " }}>{{$valor}}</option>
            @endforeach
        </select>

    </form>
    <br><br>
    <table class="table table-hover tabela">
        <thead>
            <tr>
                <th>Matricula</th>
                <th>Nome</th>
                <th>Visualizar perfil</th>
                <th>Alterar</th>
                <th>Excluir matricula</th>
                <th>Rematricular</th>
            </tr>   
        </thead>
        <tbody>

            @foreach($alunos as $aluno)
            <tr>
                <td>{{$aluno->usuario_aluno}}</td>
                <td>{{$aluno->nome}}</td>
                <td><a class="btn btn-default" href="{{ route('listar_alunos.visualizar_aluno',['id' => $aluno->usuario_aluno]) }}" role="button">Visualizar</a></td>
                <td><a class="btn btn-default" href="{{ route('listar_alunos.alterar_aluno',['id' => $aluno->usuario_aluno]) }}" role="button">Alterar</a></td>
                <td><a class="btn btn-default" href="{{ route('listar_alunos.excluir_aluno',['id' => $aluno->usuario_aluno]) }}" role="button" onclick="return confirm('Tem certeza que quer deletar?');">Excluir</a></td>
                <td><a class="btn btn-default" href="#" role="button">Rematricular</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>

</script>
@endsection