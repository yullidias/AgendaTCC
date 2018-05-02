@extends('layout')

@section('titulo','Cadastro Professor')

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
<form action="{{ route('salvar_cadastro_professor') }}" method="post">
	{{ csrf_field() }}
	<div class="col-xs-8">
	<div class='form-group'>
		<label>SIAPE</label>
		<input type='text' class='form-control' name='SIAPE' required>
		<label>Nome</label>
		<input type='text' class='form-control' name='nome' required>
		<label>Email</label>
		<input type='text' class='form-control' name='email' required>
		<label>Senha</label>
		<input type='password' class='form-control' name='senha' required>
	</div>
	

		
	<br><input style="float: right" type='submit' class='btn btn-default' value='Cadastrar'>
	</div>
</form>
@endsection
