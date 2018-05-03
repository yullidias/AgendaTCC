@extends('layout')

@section('titulo','Dados Cadastrais Professor')

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
		@foreach ($professor as $prof)
		<label>SIAPE</label>
		<input type='text' class='form-control' name='SIAPE' value="{{$prof->SIAPE}}" >
		<label>Nome</label>
		<input type='text' class='form-control' name='nome' value="{{$prof->nome}}" >
		<label>Email</label>
		<input type='text' class='form-control' name='email' value="{{$prof->email}}" >
		<label>Senha</label>
		<input type='password' class='form-control' name='senha' value="{{$prof->senha}}" >
		@endforeach
	</div>
	</div>

    <br><br>
    <div class="col-xs-8">
    <input style="float: right" type='submit' class='btn btn-default' value='Alterar'>
    </div>

@endsection
