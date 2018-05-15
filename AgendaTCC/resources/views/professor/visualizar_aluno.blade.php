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

			<label>Disciplina</label>
			<div class="radio">
				<label>
					<input type="radio" name="materia" value="1" {{ ($aluno->materia==1) ? "checked": "disabled" }}  > TCC1
				</label>
				&ensp;
				<label>
					<input type="radio" name="materia" value="2" {{ ($aluno->materia==2) ? "checked": "disabled" }}  > TCC2
				</label>
			</div><br>

			@if(isset($aluno->orientador))
				<label>Orientador</label>
				<input type='text' class='form-control' name='orientador' value="{{$aluno->orientador}} " readonly><br>
			@endif
		</div>
	</form>
		<h3><strong>Histórico de Submissões</strong></h3>
		<a class="btn btn-default" href="{{ url('/download/201522040471_Pré-Projeto.txt')  }}" target="_blank">
			Baixar
		</a>
	</div>



@endsection
