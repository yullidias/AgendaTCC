@extends('layout')

@section('titulo','Cadastro Aluno')

@section('camposnavbar')
<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
<br><br>
<form action="{{ route('cadastrar_aluno') }}" method="post">
	{{ csrf_field() }}
	<div class='form-group'>
		<label>Nome</label>
		<input type='text' class='form-control' name='nome' required>
		<label>Materia</label>
		<input type='text' class='form-control' name='materia' required>
		<label>Email</label>
		<input type='text' class='form-control' name='email' required>
		<label>Senha</label>
		<input type='text' class='form-control' name='senha' required>
		<label>Tema</label>
		<input type='text' class='form-control' name='tema' required>
	</div>
	<div class="form-group">
		<label for="sel1">Orientador</label>
		<select class="form-control" id="sel1">
			<option>Orientador 1</option>
			<option>Orientador 2</option>
			<option>Orientador 3</option>
			<option>Orientador 4</option>
		</select>
	</div>
	<div class="form-group">
		<label for="sel1">Coorientador</label>
		<select class="form-control" id="sel2">
			<option>Coorientador 1</option>
			<option>Coorientador 2</option>
			<option>Coorientador 3</option>
			<option>Coorientador 4</option>
		</select>
	</div>
		
	<br><input type='submit' class='btn btn-default' value='Cadastrar'>
</form>
@endsection