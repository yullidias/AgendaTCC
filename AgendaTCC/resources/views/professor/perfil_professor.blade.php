@extends('layout')

@section('titulo','Dados Cadastrais Professor')

@section('camposnavbar')
<li><a href="{{ route('listar_professores') }}">Professor</a></li>
@endsection

@section('conteudo')
<br><br>
<form action="{{ route('solicitar_alteracao_professor') }}" method="post">
	{{ csrf_field() }}

<!--	<table>

		<tbody>
		@foreach ($professor as $prof)
			<dl class="dl-horizontal">
			<dt>Nome:</dt>	 <dd>{{$prof->nome}}</dd>
			<dt>SIAPE:</dt>	 <dd>{{$prof->SIAPE}}</dd>
			<dt>E-mail:</dt>	 <dd>{{$prof->email}}</dd>
			<dt>Senha:</dt>	 <dd>{{$prof->senha}}</dd>
			</dl>

		@endforeach

		

		</tbody>
	</table>-->

	<div class="col-xs-8">
	<div class='form-group'>
		@foreach ($professor as $prof)
		<label>SIAPE</label>
		<input type='text' class='form-control' name='SIAPE' value="{{$prof->SIAPE}}" readonly>
		<label>Nome</label>
		<input type='text' class='form-control' name='nome' value="{{$prof->nome}}" readonly>
		<label>Email</label>
		<input type='text' class='form-control' name='email' value="{{$prof->email}}" readonly>
		<label>Senha</label>
		<input type='password' class='form-control' name='senha' value="{{$prof->senha}}" readonly>
		@endforeach
	</div>
	</div>



@endsection
