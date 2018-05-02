@extends('layout')

@section('titulo','Cadastro Aluno')

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
<form action="{{ route('salvar_cadastro_aluno') }}" method="post">
	{{ csrf_field() }}
	<div class="col-xs-8">
	<div class='form-group'>
		<label>Matrícula</label>
		<input type='text' class='form-control' name='matricula' required>
		<label>Nome</label>
		<input type='text' class='form-control' name='nome' required>
		<label>Email</label>
		<input type='text' class='form-control' name='email' required>
		<label>Senha</label>
		<input type='password' class='form-control' name='senha' required>
		<label>Tema</label>
		<input type='text' class='form-control' name='tema' required>
	</div>
	<div class="form-group">
		<label for="orientador">Orientador</label>
		<select class="form-control" name="orientador">
			@foreach ($professor as $prof)
			<option>{{$prof->nome}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label for="coorientador">Coorientador</label>
		<select class="form-control" name="coorientador">
			@foreach ($professor as $prof)
				<option>{{$prof->nome}}</option>
			@endforeach
		</select>
	</div>

	<br><label>Matéria</label>

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
		
	<br><input style="float: right" type='submit' class='btn btn-default' value='Cadastrar'>
	</div>
</form>
@endsection