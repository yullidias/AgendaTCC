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
<br><br>
	<h3>1. Atitude e Desenvolvimento (30 pontos)</h3>
	<h3>2. Avaliação do trabalho escrito quanto à forma (30 pontos)</h3>
	<h3>3. Avaliação do trabalho escrito quanto ao conteúdo (40 pontos)</h3>
	<form action="{{ route('salvar_avaliacao') }}" method="post">
		{{ csrf_field() }}
		<div class="col-xs-8">
			<div class='form-group'>
				<label>Atitude e Competência</label>
				<input type='text' class='form-control' name='atitudeCompetencia' required>
				<label>Forma</label>
				<input type='text' class='form-control' name='forma' required>
				<label>Conteúdo</label>
				<input type='text' class='form-control' name='conteudo' required>
			</div>



			<br><input style="float: right" type='submit' class='btn btn-default' value='Salvar'>
		</div>
	</form>

@endsection
