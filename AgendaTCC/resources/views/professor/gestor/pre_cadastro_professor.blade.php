@extends('layout')

@section('titulo','Pré Cadastro Professor')

@section('voltar')
<a href="{{ route('listar_alunos') }}"><spa class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection

@section('camposnavbar')
<li><a href="{{ route('listar_professores') }}">Prefessor</a></li>
@endsection

@section('conteudo')
<div class='col-md-4 col-md-offset-1'>
	<form action="{{ route('listar_professores.pre_cadastro_professor.salvar_pre_cadastro_professor') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
			<label>SIAPE</label>
			<input type='text' class='form-control' name='id' required>
			<span class="text-danger">{{ $errors->has('id') ? 'SIAPE já cadastrado! Tente novamente' : ''}}</span>
		</div>

		<br><label>Permissão</label>
		<div class="checkbox">
		  <label>
		    <input type="checkbox" name="permissao_orientador" value="1" checked> Orientador
		  </label>

		  <label>
		    <input type="checkbox" name="permissao_professorDisciplina" value="1"> Professor da Disciplina
		  </label>

		  <label>
		    <input type="checkbox" name="permissao_gestor" value="1"> Gestor
		  </label>
		</div>
		
			
		<br><input type='submit' class='btn btn-default' value='Cadastrar'>
	</form>
</div>
@endsection