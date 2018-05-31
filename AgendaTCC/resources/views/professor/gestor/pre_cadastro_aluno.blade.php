@extends('layout')

@section('titulo','Pré Cadastro Aluno')

@section('voltar')
<a href="{{ route('listar_alunos') }}"><span class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection

@section('camposnavbar')
<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
<div class='col-md-4 col-md-offset-1'>
	<form action="{{ route('listar_alunos.pre_cadastro_alunos.salvar_pre_cadastro_aluno') }}" method="post">
		{{ csrf_field() }}
		
		<div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
			<label>Matricula</label>
			<input type='text' class='form-control' name='id' required>

			@foreach($errors->all() as $error)
				<span class="text-danger">{{ $error }}</span>
			@endforeach
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