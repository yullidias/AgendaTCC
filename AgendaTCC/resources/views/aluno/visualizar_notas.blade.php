@extends('layout')

@section('titulo','Notas TCC1')



@section('conteudo')
	
	<div class="col-xs-8">
		<label>Aluno</label>
		<!--<input type='text' class='form-control' name='nome' value="{{$aluno->nome}}" readonly><br>
		<input type='text' class='form-control' name='usuario_aluno' value="{{$aluno->usuario_aluno}}" readonly--><br>

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
						<td><input type='text' class='form-control' name='atitudeCompetencia2' value="{{$avaliacaosProf->atitudeCompetencia}}" readonly></td>
						@else
							<td><input type='text' class='form-control' name='atitudeCompetencia2'  readonly></td>
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
						<td><input type='text' class='form-control' name='forma2' value="{{$avaliacaosProf->forma}}" readonly></td>
						@else
							<td><input type='text' class='form-control' name='forma2' readonly></td>
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
							<td><input type='text' class='form-control' name='conteudo2' value="{{$avaliacaosProf->conteudo}}" readonly></td>
						@else
							<td><input type='text' class='form-control' name='conteudo2' readonly></td>
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
						<td><input style="height: 80px" type='text' class='form-control' name='comentario2' value="{{$avaliacaosProf->comentario}}" readonly></td>
						@else
							<td><input style="height: 80px" type='text' class='form-control' name='comentario2' readonly></td>
						@endif
					</tr>

				</table>

			</div>
			<br><input style="float: right" type='submit' class='btn btn-default' value='Salvar'>

			<!--<h3><strong>Histórico de Avaliações</strong></h3>-->
		</div>
	</form>

@endsection
