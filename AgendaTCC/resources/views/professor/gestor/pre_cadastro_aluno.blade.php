@extends('layout')

@section('titulo','Pré Cadastro')

@section('camposnavbar')
<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
<br><br>
<form action="{{ route('salvar_pre_cadastro_aluno') }}" method="post">
	{{ csrf_field() }}
	<div class='form-group'>
		<label>Matricula</label>
		<input type='text' class='form-control' name='matricula' required>
	</div>

	<br><label>Matéria</label>
	<div class="radio">
	  <label>
	    <input type="radio" name="materia" value="1" checked> TCC1
	  </label>
	</div>
	<div class="radio">
	  <label>
	    <input type="radio" name="materia" value="1"> TCC2
	  </label>
	</div>
		
	<br><input type='submit' class='btn btn-default' value='Cadastrar'>
</form>
@endsection