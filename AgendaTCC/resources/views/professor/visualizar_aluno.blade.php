@extends('layout')

@section('titulo','Dados do Aluno')

@section('camposnavbar')
	<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
	<div class="flash-message">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			@if(Session::has('alert-' . $msg))

				<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			@endif
		@endforeach
	</div> <!-- end .flash-message -->
	<br>
	<div class='col-md-6 col-md-offset-1'>
	<form>
		{{ csrf_field() }}

		<div class='form-group'>
			@if(isset($aluno->nome))
				<label>Aluno</label>
				<input type='text' class='form-control' name='nome' value="{{$aluno->nome}}" readonly><br>
			@endif

				@if(isset($aluno->tema))
					<label>Tema</label>
					<input type='text' class='form-control' name='tema' value="{{$aluno->tema}}" readonly><br>
				@endif


			@if(isset($aluno->email))
				<label>E-mail</label>
				<input type='text' class='form-control' name='email' value="{{$aluno->email}}" readonly><br>
			@endif

			@if(isset($aluno->orientador))
				<label>Orientador</label>
				<input type='text' class='form-control' name='orientador' value="{{$aluno->orientador}} " readonly><br>
			@endif
				<label>Disciplina</label>
				<div class="radio">
					<label>
						<input type="radio" name="materia" value="1" {{ ($aluno->materia==1) ? "checked": "disabled" }}  > TCC1
					</label>
					&ensp;
					<label>
						<input type="radio" name="materia" value="2" {{ ($aluno->materia==2) ? "checked": "disabled" }}  > TCC2
					</label>
				</div>
		</div>
	</form>
		<h3><strong>Histórico de Submissões</strong></h3>
		<table style="width:100%; background-color: #E6E6FA;" class="table table-hover">
		<tr>
		<td><label>Pré-Projeto</label></td>
			@if(isset($aluno->nomeArquivo))
			<td><a class="btn btn-default" href="{{ url('/download/'.$aluno->usuario_aluno.'_Pré-Projeto.pdf')  }}" target="_blank">
			Baixar
			</a></td>
			@else
				<td><h5>Ainda não submetido</h5></td>
			@endif
		</tr>
			<br><br>
		<tr>
			<td><label>TCC</label></td>
			@if(isset($aluno->nomeArquivo))
			<td><a class="btn btn-default" href="{{ url('/download/'.$aluno->usuario_aluno.'_TCC.pdf')  }}" target="_blank">
			Baixar
			</a></td>
			@else
				<td><h5>Ainda não submetido</h5></td>
			@endif
		</tr>
		<table>
	</div>



@endsection
