@extends('layout')

@section('titulo','Itens de Avaliação')

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
	<form action="{{ route('salvar_avaliacao') }}" method="post">
		{{ csrf_field() }}
	<div class="col-xs-8">
		<label>Aluno</label>
		<input type='text' class='form-control' name='nome' value="{{$aluno->nome}}" readonly><br>
		<input type='text' class='form-control' name='usuario_aluno' value="{{$aluno->usuario_aluno}}" readonly><br>


	<h5>1. Atitude e Desenvolvimento (30 pontos)</h5>
	<h5>2. Avaliação do trabalho escrito quanto à forma (30 pontos)</h5>
	<h5>3. Avaliação do trabalho escrito quanto ao conteúdo (40 pontos)</h5>
	</div>
	<br/><br/>
		<div class="col-xs-8">
			<div class='form-group'>
				<table style="width:100%" class="table table-hover">
					<thead>
					<tr>
						<td></td>
						<th>Nota Professor (NP)</th>
						<th>Nota Orientador (NO)</th>
					</tr>
					</thead>
					<tr>
						<td><label>Atitude e Competência</label></td>
						<td><input type='text' class='form-control' name='atitudeCompetencia' required></td>
						<td>nota orientador</td>
					</tr>
					<tr>
						<td><label>Forma</label></td>
						<td><input type='text' class='form-control' name='forma' required></td>
						<td>nota orientador</td>
					</tr>
					<tr>
						<td><label>Conteúdo</label></td>
						<td><input type='text' class='form-control' name='conteudo' required></td>
						<td>nota orientador</td>
					</tr>
					<tr>
						<td><label>Comentários</label></td>
						<td><input type='text' class='form-control' name='comentario' required></td>
					</tr>
				</table>
			</div>



			<br><input style="float: right" type='submit' class='btn btn-default' value='Salvar'>
		</div>
	</form>

@endsection
