@extends('layout')

@section('titulo','Cadastro Aluno')

@section('camposnavbar')
<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
<br><br>
<form action="{{ route('salvar_cadastro_aluno') }}" method="post">
	{{ csrf_field() }}
	<div class='form-group'>
		<label>Matrícula</label>
		<input type='text' class='form-control' name='matricula' required>
		<label>Nome</label>
		<input type='text' class='form-control' name='nome' required>
		<label>Email</label>
		<input type='text' class='form-control' name='email' required>
		<label>Senha</label>
		<input type='password' class='form-control' name='senha' required>
		<label>Tema</label>
		<input type='text' class='form-control' name='tema' required>
	</div>
	<div class="form-group">
		<label for="orientador">Orientador</label>
		<select class="form-control" name="orientador">
			<option>11111</option>
			<option>22222</option>
			<option>33333</option>
			<option>44444</option>
		</select>
	</div>
	<div class="form-group">
		<label for="coorientador">Coorientador</label>
		<select class="form-control" name="coorientador">
			<option>Coorientador 1</option>
			<option>Coorientador 2</option>
			<option>Coorientador 3</option>
			<option>Coorientador 4</option>
		</select>
	</div>
	<br><label>Matéria</label>

	<div class="radio">
		<label>
			<input type="radio" name="materia" value="1" checked> TCC1
		</label>
	</div>
	<div class="radio">
		<label>
			<input type="radio" name="materia" value="2"> TCC2
		</label>
	</div>
		
	<br><input type='submit' class='btn btn-default' value='Cadastrar'>
</form>
@endsection