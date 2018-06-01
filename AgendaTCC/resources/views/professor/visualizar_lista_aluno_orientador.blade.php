@extends('layout')

@section('titulo','Lista de Alunos')

@section('camposnavbar')
<li><a href="{{ route('listar_professores') }}">Professor</a></li>
@endsection

@section('conteudo')
	<div class="flash-message">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			@if(Session::has('alert-' . $msg))

				<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			@endif
		@endforeach
	</div> <!-- end .flash-message -->

<form action="{{ route('visualizar_lista_alunos_orientador', ['id' => $orientador->id]) }}" method="post">
	{{ csrf_field() }}

	<h5><strong> Campos: </strong></h5>
	<div class="radio">
		<label>
			<input type="radio" name="materia" onchange="this.form.submit()" value="1" {{ ($materia_selecionada==1) ? "checked": " " }}  > TCC1
		</label>
		&ensp;
		<label>
			<input type="radio" name="materia" onchange="this.form.submit()" value="0" {{ ($materia_selecionada==0) ? "checked": " " }}> TCC2
		</label>
	</div>
	<br>
	<label>Semestre</label>
	<select class="form-control" style="width:100px" onchange="this.form.submit()" name="semestre">
	@foreach($semestres as $semestre)
		{{ $valor = $semestre->numero.'-'.$semestre->ano }}
		<option value="{{$valor}}" {{ ($semestre_selecionado==$valor) ? "selected ": " " }}>{{$valor}}</option>
		@endforeach
	</select>
</form>
	<br/><br>
	<table style="width:100%" class="table table-hover">
		<tr>
			<th>Matrícula</th>
			<th>Vizualizar Perfil</th>
			<th>Avaliar</th>
		</tr>
		@foreach ($alunos as $aluno)
			<tr>
				<td>{{$aluno->usuario_aluno}}</td>
				<td><a class="btn btn-default" href="{{ route('visualizar_aluno',['id' => $aluno->usuario_aluno]) }}" role="button">Visualizar</a></td>
				<td><a class="btn btn-default" href="{{ route('avaliar_aluno',['id' => $aluno->usuario_aluno]) }}" role="button">Avaliar</a></td>
			</tr>
		@endforeach



@endsection
