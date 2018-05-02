@extends('layout')

@section('titulo','Dados Cadastrais Aluno')

@section('camposnavbar')
<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
<br><br>
<form action="{{ route('solicitar_alteracao_aluno') }}" method="post">
	{{ csrf_field() }}

<!--	<table>

		<tbody>
		@foreach ($aluno as $alun)
			<dl class="dl-horizontal">
			<dt>Nome:</dt>	 <dd>{{$alun->nome}}</dd>
			<dt>Matrícula:</dt>	 <dd>{{$alun->matricula}}</dd>
			<dt>E-mail:</dt>	 <dd>{{$alun->email}}</dd>
			<dt>Senha:</dt>	 <dd>{{$alun->senha}}</dd>
			</dl>

		@endforeach
		@foreach ($tccDados as $tcc)
			<dl class="dl-horizontal">
				<dt>Tema:</dt>	<dd>{{$tcc->tema}}</dd>
				<dt>Orientador:</dt>	<dd>{{$tcc->orientador}}</dd>
				<dt>Coorientador:</dt>	<dd>{{$tcc->coorientador}}</dd>
			</dl>

		@endforeach

		</tbody>
	</table>-->

	<div class="col-xs-8">
	<div class='form-group'>
		@foreach ($aluno as $alun)
		<label>Matrícula</label>
		<input type='text' class='form-control' name='matricula' value="{{$alun->matricula}}" readonly>
		<label>Nome</label>
		<input type='text' class='form-control' name='nome' value="{{$alun->nome}}" readonly>
		<label>Email</label>
		<input type='text' class='form-control' name='email' value="{{$alun->email}}" readonly>
		<label>Senha</label>
		<input type='password' class='form-control' name='senha' value="{{$alun->senha}}" readonly>
		@endforeach
	</div>
	</div>
	
	<div class="col-xs-8">
	<div class='form-group'>
		@foreach ($tccDados as $tcc)
		<label>Tema</label>
		<input type='text' class='form-control' name='tema' value="{{$tcc->tema}}" readonly>
		<label>Orientador</label>
		<input type='text' class='form-control' name='orientador' value="{{$tcc->orientador}}" readonly>
		<label>Coorientador</label>
		<input type='text' class='form-control' name='coorientador' value="{{$tcc->coorientador}}" readonly>
		@endforeach
	</div>
	</div>



@endsection
