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

                <form action="{{ route('listar_alunos.operacoes_aluno') }}" method="post">
                  <input type='hidden' name='id' value="{{$aluno->usuario_aluno}}" />
                  <input type='hidden' name='semestre_selecionado' value="{{$semestre_selecionado}}" />
                  <input type='hidden' name='materia_selecionada' value="{{$materia_selecionada}}" />
                  <td><input type='submit' name='operacao' class='btn btn-default' value='Visualizar'></td>
                  <td><input type='submit' name='operacao' class='btn btn-default' value='Alterar'></td>
                  <td><input type='submit' name='operacao' class='btn btn-default' value='Excluir'onclick="return confirm('Tem certeza que quer deletar?');"></td>
                </form>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>

</script>
@endsection