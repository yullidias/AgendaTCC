@extends('layout')

@section('titulo','Dados Cadastrais Aluno')

@section('camposnavbar')
<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>
@endsection

@section('conteudo')
<br><br>
<form action="{{ route('solicitar_alteracao_aluno') }}" method="post">
	{{ csrf_field() }}

	<table>

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
	</table>



@endsection