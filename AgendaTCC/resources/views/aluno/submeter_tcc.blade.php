@extends('layout')

@section('titulo','Submeter TCC')

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

<form action="{{ route('salvar_submeter_tcc') }}" method="post"  enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="col-xs-8">
		<table style="width:100%" class="table table-hover">
			<tr>
				<td>
					<div class="radio">
						<label>
							<input type="radio" name="materia" value="1" {{ ($materia_selecionada==1) ? "checked": " " }} readonly > TCC1
						</label>
					&ensp;
						<label>
							<input type="radio" name="materia" value="2" {{ ($materia_selecionada==2) ? "checked": " " }} readonly> TCC2
						</label>
					</div>
				</td>
				<td>
					<div class="form-group">
						<select class="form-control" name="tipo">
							<option>Pré-Projeto</option>
							<option>TCC</option>
						</select>
					</div>
				</td>
			</tr>
		</table>
		@foreach($alunos as $aluno)
			<label>Aluno</label><br>
			<input type="text" class='form-control' name="usuario_aluno" value="{{$aluno->usuario_aluno}}" readonly>
		@endforeach
			<br>

		<label>Arquivo</label>
		<input type="file" class='form-control' name="file" required><br>
		<label>Comentário</label>
		<input style="height: 100px" type='text' class='form-control' name='comentario' >
		<br/><br>
		<input style="float: right" type="submit" class='btn btn-default' value='Enviar'>
	</div>
</form>


@endsection
