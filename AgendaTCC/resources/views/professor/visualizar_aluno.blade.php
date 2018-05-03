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
	<form action="{{ route('solicitar_alteracao_aluno') }}" method="post">
		{{ csrf_field() }}

		<div class='form-group'>
			@foreach ($aluno as $alun)
				<label class="col-xs-11">Nome</label>
				<table class="col-xs-6">
					<tr>
						<td><input type='text' class='form-control' name='nome' size="20" value="{{$alun->nome}}" readonly></td>
					</tr>
				</table>
				<label class="col-xs-11">Email</label>
				<table class="col-xs-6">
					<tr>
						<td><input type='text' class='form-control' name='email' size="20" value="{{$alun->email}}" readonly></td>
					</tr>
				</table>

			@endforeach
		</div>

		<div class='form-group'>
			@foreach ($tccDados as $tcc)
				<label class="col-xs-11">Tema</label>
				<table class="col-xs-6">
					<tr>
						<td><input type='text' class='form-control' name='tema' value="{{$tcc->tema}}" readonly></td>
					</tr>
				</table>
				<label class="col-xs-11" >Orientador</label>
				<table class="col-xs-6">
					<tr>
						<td><input type='text' class='form-control' name='orientador'  size="20" value="{{$tcc->orientador}}" readonly></td>
					</tr>
				</table>
			@endforeach
		</div>



@endsection
