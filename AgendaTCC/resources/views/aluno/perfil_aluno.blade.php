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
	<div class="col-xs-6">
	<div class='form-group'>
		@foreach ($aluno as $alun)
            <label>Matrícula</label>
            <input type='text' class='form-control' name='matricula' value="{{$alun->id}}" readonly>
            <label>Nome</label>
            <input type='text' class='form-control' name='nome' value="{{$alun->nome}}" readonly>
            <label>Email</label>
            <input type='text' class='form-control' name='email' value="{{$alun->email}}" readonly>
            <label>Senha</label>
            <input type='password' class='form-control' name='senha' value="" readonly>
		@endforeach
	</div>
	</div>
	<div class="col-xs-10">
	<div class='form-group'>
		@foreach ($tccDados as $tcc)

		<table style="width:100%" class="table table-hover">
			<tr>
				<td><label>Matéria</label></td>
			</tr>
			<tr>
				<td><input type="radio" name="materia" value="1" @if($alunoSemestre->materia == 1) checked @endif readonly> TCC1
					<input type="radio" name="materia" value="2" @if($alunoSemestre->materia == 2) checked @endif readonly> TCC2</td>
				<td><button type='submit' class='btn btn-default' name="solicitar" value = 'Turma TCC-{{$alunoSemestre['materia']}}' href="{{ route('solicitar_alteracao_aluno')}}">Solicitar Alteração</button></td>
			</tr>
			<tr>
				<td><label>Orientador</label></td>
			</tr>
			<tr>
				<td><input type='text' class='form-control' name='orientador' value="{{$tcc->orientador}}" readonly></td>
				<td><button type='submit' class='btn btn-default' name="solicitar" value = 'Orientador-{{$tcc->orientador}}' href="{{ route('solicitar_alteracao_aluno')}}">Solicitar Alteração</button></td>
			</tr>
			<tr>
				<td><label>Coorientador</label></td>
			</tr>
			<tr>
				<td><input type='text' class='form-control' name='coorientador' value="{{$tcc->coorientador}}" readonly></td>
				<td><button type='submit' class='btn btn-default' name="solicitar" value = 'Coorientador-{{$tcc->coorientador}}' href="{{ route('solicitar_alteracao_aluno')}}">Solicitar Alteração</button></td>
			</tr>
			<tr>
				<td><label>Tema</label></td>
			</tr>
			<tr>
				<td><input type='text' class='form-control' name='tema' value="{{$tcc->tema}}" readonly></td>
				<td><button type='submit' class='btn btn-default' name="solicitar" value = 'Tema-{{$tcc->tema}}' href="{{ route('solicitar_alteracao_aluno')}}">Solicitar Alteração</button></td>
			</tr>

			@if($alunoSemestre->materia == 2)
				@php
					if($agendamento){
						$membro1banca = $agendamento->membro1banca;
						$membro2banca = $agendamento->membro2banca;
					}
					else{
						$membro1banca = "";
						$membro2banca = "";
					}
				@endphp
				<tr>
					<td><label>Membros da Banca</label></td>
				</tr>
				<tr>
					<td><input type='text' class='form-control' name='membro1' value="{{$membro1banca}}" readonly></td>
					<td><button type='submit' class='btn btn-default' name="solicitar" value = 'Membro Banca-{{$membro1banca}}' href="{{ route('solicitar_alteracao_aluno')}}">Solicitar Alteração</button></td>

					<tr></tr>

					<td><input type='text' class='form-control' name='membro2' value="{{$membro2banca}}" readonly></td>
					<td><button type='submit' class='btn btn-default' name="solicitar" value = 'Membro Banca-{{$membro2banca}}' href="{{ route('solicitar_alteracao_aluno')}}">Solicitar Alteração</button></td>
				</tr>
			@endif
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
	</div>



@endsection
