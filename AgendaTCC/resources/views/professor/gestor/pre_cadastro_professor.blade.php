@extends('layout')

@section('titulo','Pré Cadastro Professor')

@section('camposnavbar')
<li><a href="{{ route('listar_professores') }}">Prefessor</a></li>
@endsection

@section('conteudo')
<div class='col-md-4 col-md-offset-1'>
	<br><br>
	<form action="{{ route('salvar_pre_cadastro_professor') }}" method="post">
		{{ csrf_field() }}
		<div class='form-group'>
			<label>SIAPE</label>
			<input type='text' class='form-control' name='SIAPE' required>
		</div>

		<br><label>Permissão</label>
		<div class="checkbox">
		  <label>
		    <input type="checkbox" name="permissao_orientador" value="1" checked> Orientador
		  </label>
		</div>

		<div class="checkbox">
		  <label>
		    <input type="checkbox" name="permissao_professorDisciplina" value="1"> Professor da Disciplina
		  </label>
		</div>
		
		<div class="checkbox">
		  <label>
		    <input type="checkbox" name="permissao_gestor" value="1"> Gestor
		  </label>
		</div>
		
			
		<br><input type='submit' class='btn btn-default' value='Cadastrar'>
	</form>
</div>
@endsection