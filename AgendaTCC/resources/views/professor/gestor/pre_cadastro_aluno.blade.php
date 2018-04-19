@extends('layout')

@section('titulo','Pré Cadastro Aluno')

@section('camposnavbar')
<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
<div class='col-md-4 col-md-offset-1'>
	<br><br>
	<form action="{{ route('salvar_pre_cadastro_aluno') }}" method="post">
		{{ csrf_field() }}
		
		<div class="form-group {{ $errors->has('matricula') ? 'has-error' : '' }}">
			<label>Matricula</label>
			<input type='text' class='form-control' name='matricula' required>
			<span class="text-danger">{{ $errors->has('matricula') ? 'Matricula já cadastrada! Tente novamente' : ''}}</span>
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
</div>
@endsection