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
		<!--<input type='text' class='form-control' name='nome' value="{{$aluno->nome}}" readonly><br>-->
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
						@if(isset($avaliacaosProf->atitudeCompetencia))
						<td><input type='text' class='form-control' name='atitudeCompetencia2' value="{{$avaliacaosProf->atitudeCompetencia}}" required></td>
						@else
							<td><input type='text' class='form-control' name='atitudeCompetencia2'  required></td>
						@endif

						@if(isset($avaliacaosOrient->atitudeCompetencia))
						<td><input type='text' class='form-control' name='atitudeCompetencia' value="{{$avaliacaosOrient->atitudeCompetencia}}" readonly></td>
						@else
							<td><input type='text' class='form-control' name='atitudeCompetencia'  readonly></td>
						@endif
					</tr>
					<tr>
						<td><label>Forma</label></td>
						@if(isset($avaliacaosProf->forma))
						<td><input type='text' class='form-control' name='forma2' value="{{$avaliacaosProf->forma}}" required></td>
						@else
							<td><input type='text' class='form-control' name='forma2' required></td>
						@endif
						@if(isset($avaliacaosOrient->forma))
                        <td><input type='text' class='form-control' name='forma' value="{{$avaliacaosOrient->forma}}" readonly></td>
						@else
							<td><input type='text' class='form-control' name='forma' readonly></td>
						@endif
					</tr>
					<tr>
						<td><label>Conteúdo</label></td>
						@if(isset($avaliacaosProf->conteudo))
							<td><input type='text' class='form-control' name='conteudo2' value="{{$avaliacaosProf->conteudo}}" required></td>
						@else
							<td><input type='text' class='form-control' name='conteudo2' required></td>
						@endif
						@if(isset($avaliacaosOrient->conteudo))
							<td><input type='text' class='form-control' name='conteudo' value="{{$avaliacaosOrient->conteudo}}" readonly></td>
						@else
							<td><input type='text' class='form-control' name='conteudo' readonly></td>
						@endif
					</tr>
					<tr>
						<td><label>Comentários</label></td>
						@if(isset($avaliacaosProf->comentario))
						<td><input style="height: 80px" type='text' class='form-control' name='comentario2' value="{{$avaliacaosProf->comentario}}" required></td>
						@else
							<td><input style="height: 80px" type='text' class='form-control' name='comentario2' required></td>
						@endif
					</tr>

				</table>

			</div>
			<br><input style="float: right" type='submit' class='btn btn-default' value='Salvar'>

			<!--<h3><strong>Histórico de Avaliações</strong></h3>-->
		</div>
	</form>

@endsection
