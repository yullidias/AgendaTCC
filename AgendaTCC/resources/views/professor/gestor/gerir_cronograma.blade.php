@extends('layout')

@section('titulo','Cronograma')

{{--@section('camposnavbar')--}}
{{--<li><a href="{{ route('listar_alunos') }}">Aluno</a></li>--}}
{{--@endsection--}}

@section('conteudo')

	<div class="flash-message">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			@if(Session::has('alert-' . $msg))

				<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			@endif
		@endforeach
	</div> <!-- end .flash-message -->


	<form action="{{ route('cronograma.salvar_atividade_cronograma') }}" method="post">
		{{ csrf_field() }}
		<div class='form-group' >
			<label>Nome</label>
			<input type='text' class='form-control' name='nome' required>
			<label>Data de Início</label>
			<input type='date' class='form-control' name='data_inicio' required>
			<label>Data de Fim</label>
			<input type='date' class='form-control' name='data_fim' required>
		</div>

		<label>Semestre: </label>
		@if($semestre != null)
			<h10>{{$semestre->ano.'-'.$semestre->numero}}</h10>
		@else
			<h10> - </h10>
		@endif

		<label>Turma</label>
		<select id="listbox_turma", name="turma">
			<option value="1">TCC 1</option>
			<option value="2">TCC 2</option>
		</select>
		<br>
		<input type='submit' class='btn btn-default' value='Cadastrar'>
	</form>
	{{-------------------Inicio Tabela-----------------------}}
	<style>
		table {
			table-layout: fixed;
			width: 100px;
		}

		th, td {
			text-align: left;
			padding: 8px;
		}
		th {
			background-color: #404040;
			color: white;
		}
	</style>

	<br><br>

	{{ csrf_field() }}
	<table style="width:100%" class="table table-hover">
		<tr>
			<th>Descrição</th>
			<th>Semestre</th>
			<th>Turma</th>
			<th>Data Início</th>
			<th>Data Fim</th>
			<th>Salvar</th>
			<th>Excluir Atividade</th>
		</tr>
		@foreach($cronogramas as $c)
			<tr>
				<td>{{$c->nome}}</td>
				<td>{{$c->semestre_ano}}-{{$c->semestre_numero}}</td>
				<td>TCC {{$c->turma}}</td>
				<form action="{{ route('cronograma.atualizar_atividade_cronograma')}}" method="post">
					<td><input type='date' class='form-control' name='data_inicio' value="{{$c->data_inicio}}" width="10" required></td>
					<td><input type='date' class='form-control' name='data_fim' value="{{$c->data_fim}}" width="10" required></td>
					<td><button type='submit' class='btn btn-default'  onclick="return confirm('Salvar alterações?');" name="Salvar" value = '{{$c->id}}' href="{{ route('cadastrar_cronograma.atualizar_atividade_cronograma', $c->id)}}">Salvar</td>
				</form>
				{{--acrescentar campos semestre_ano, semestre_numero e turma de cronograma--}}
				<form action="{{ route('cronograma.deletar_atividade_cronograma')}}" method="post">
					<td><button type='submit' class='btn btn-default'  onclick="return confirm('Tem certeza que quer deletar?');" name="Excluir" value = '{{$c->id}}' href="{{ route('cadastrar_cronograma.deletar_atividade_cronograma', $c->id)}}">Excluir</td>

			</tr>
		@endforeach
	</table>

	{{---------------------Fim Tabela------------------------}}
@endsection