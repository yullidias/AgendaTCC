@extends('layout')

@section('titulo','Dados Cadastrais Aluno')

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
<form action="{{ route('solicitar_alteracao_aluno') }}" method="post">
	{{ csrf_field() }}

	<div class='form-group'>
		@foreach ($aluno as $alun)

		<label class="col-xs-8">Matrícula</label>
			<table class="col-xs-6">
				<tr>
					<td><input type='text' class='form-control' name='matricula' value="{{$alun->id}}" readonly></td>
				</tr>
			</table>
		<label class="col-xs-8">Nome</label>
			<table class="col-xs-6">
				<tr>
					<td><input type='text' class='form-control' name='nome' value="{{$alun->nome}}" readonly></td>
				</tr>
			</table>
		<label class="col-xs-8">Email</label>
			<table class="col-xs-6">
				<tr>
					<td><input type='text' class='form-control' name='email' value="{{$alun->email}}" readonly></td>
				</tr>
			</table>
		<label class="col-xs-8">Senha</label>
			<table class="col-xs-6">
				<tr>
					<td><input type='password' class='form-control' name='senha' value="" readonly></td>
				</tr>
			</table>
		@endforeach
	</div>

	<div class='form-group'>
		@foreach ($tccDados as $tcc)

		<label class="col-xs-11">Tema</label>
		<table class="col-xs-10">
			<tr>
				<td><input type='text' class='form-control' name='tema' value="{{$tcc->tema}}" readonly></td>
				<td><button type='submit' class='btn btn-default' name="solicitar" value = '{{$tcc->usuario_aluno}}' href="{{ route('solicitar_alteracao_aluno', $tcc->tema)}}">Solicitar Alteração</button></td>
			</tr>
		</table>
		<label class="col-xs-11">Orientador</label>
		<table class="col-xs-10">
			<tr>
				<td><input type='text' class='form-control' name='orientador' value="{{$tcc->orientador}}" readonly></td>
				<td><button type='submit' class='btn btn-default' name="solicitar" value = '{{$tcc->usuario_aluno}}' href="{{ route('solicitar_alteracao_aluno', $tcc->orientador)}}">Solicitar Alteração</button></td>
			</tr>
		</table>
		<label class="col-xs-11">Coorientador</label>
		<table class="col-xs-10">
			<tr>
				<td><input type='text' class='form-control' name='coorientador' value="{{$tcc->coorientador}}" readonly></td>
				<td><button type='submit' class='btn btn-default' name="solicitar" value = '{{$tcc->usuario_aluno}}' href="{{ route('solicitar_alteracao_aluno', $tcc->coorientador)}}">Solicitar Alteração</button></td>
			</tr>
		</table>
		@endforeach
	<!--	@foreach($alunoSemestre as $semestre)
			<label class="col-xs-11">Matéria</label>
			<table class="col-xs-10">
				<tr>
					<td><input type='text' class='form-control' name='coorientador' value="{{$semestre->matricula}}" readonly></td>
					<td><button type='submit' class='btn btn-default' name="solicitar" value = '{{$tcc->aluno_matricula}}' href="{{ route('solicitar_alteracao_aluno', $tcc->coorientador)}}">Solicitar Alteração</button></td>
				</tr>
			</table>

		@endforeach-->
	</div>



@endsection
