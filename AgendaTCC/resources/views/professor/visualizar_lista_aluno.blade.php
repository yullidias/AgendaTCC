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
<br><br>
<form action="{{ route('visualiza_ou_avalia_aluno') }}" method="post">
	{{ csrf_field() }}

	<h4><strong> Campos: </strong></h4>
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
	<table style="width:100%" class="table table-hover">
		<tr>
			<th>Matrícula</th>
			<th>Vizualizar Perfil</th>
			<th>Avaliar</th>
		</tr>
		@foreach ($tccDados as $tcc)
			<tr>
				<td><input type='text' class='form-control' name='matricula' value="{{$tcc->aluno_matricula}}" readonly></td>
				<td><button type='submit' class='btn btn-default' name="perfil" value = '{{$tcc->aluno_matricula}}' href="{{ route('visualiza_ou_avalia_aluno', $tcc->aluno_matricula)}}">Visualizar</button></td>
				<td><button type='submit' class='btn btn-default' name="avalia" value = '{{$tcc->aluno_matricula}}' href="{{ route('visualiza_ou_avalia_aluno', $tcc->aluno_matricula)}}">Avaliar</button></td>
			</tr>
		@endforeach



@endsection
