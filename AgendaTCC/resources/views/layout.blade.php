<!DOCTYPE html>
<html>

<head>
	<title>@yield('titulo')</title>
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/template.css') }}" rel="stylesheet">
</head>

<body>


	<!-- -->
	<nav class='navbar navbar-inverse'>
		<div class='container'>
			<div class='navbar-header'>
				<button type='button' class='navbar-toggle' collapsed data-toggle='collapse' data-target='#barra-navegacao'>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
				</button>
				<a class='navbar-brand' href='#'>AgendaTCC</a>
			</div>


			<div class='collapse navbar-collapse' id='barra-navegacao'>
				<ul class='nav navbar-nav navbar-right'>
					@if(auth()->check()){{-- se ele estiver logado --}}
						@if(auth()->user()["professor"] == 0)
                            
							<div class="btn-group pull-left ">
								<p> </p>
								<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
									Gestão do Aluno
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('perfil_aluno')}}"><strong>Meu Perfil</strong></a></li>
									{{--<li><a href="{{route('aluno_visualizar_cronograma')}}"><strong>Cronograma</strong></a></li>--}}
									<li><a href="{{route('visualizarNotas')}}" id="botaoNota"><strong>Notas</strong></a></li>
									<li><a href="{{route('submeter_tcc',['id' => auth()->user()["id"]])}}"><strong>TCC</strong></a></li>
								</div>
								<p> </p>
							</div>
                    

						@endif
						@if(auth()->user()["professor"] == 1 and auth()->user()["orientador"]==0)
							<div class="btn-group pull-left ">
								<p> </p>
								<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
									Gestão do Professor
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('cadastrar_professor')}}"><strong>Cadastrar</strong></a></li>
									<li><a href="{{route('professor_visualizar_cronograma')}}"><strong>Cronograma</strong></a></li>
									{{--<li><a href="{{route('incluir rota orientandos')}}"><strong>Orientandos</strong></a></li>--}}
									{{--<li><a href="{{route('incluir rota relatorio')}}"><strong>Relatório</strong></a></li>--}}
									<li><a href="{{route('visualizar_lista_alunos',['id' => auth()->user()["id"]])}}"><strong>Turma</strong></a></li>
								</div>

							</div>
						@endif
						@if(auth()->user()["professor"] == 1 and auth()->user()["orientador"]==1)
						<div class="btn-group pull-left ">
							<p> </p>
							<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
								Gestão do Professor
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('cadastrar_professor')}}"><strong>Cadastrar</strong></a></li>
								<li><a href="{{route('professor_visualizar_cronograma')}}"><strong>Cronograma</strong></a></li>
								{{--<li><a href="{{route('incluir rota orientandos')}}"><strong>Orientandos</strong></a></li>--}}
								{{--<li><a href="{{route('incluir rota relatorio')}}"><strong>Relatório</strong></a></li>--}}
								<li><a href="{{route('visualizar_lista_alunos_orientador',['id' => auth()->user()["id"]])}}"><strong>Turma</strong></a></li>
							</div>

						</div>
							<li><a href="{{route('salvar_agendamento')}}"><strong>Agendamento</strong></a></li>
						@endif
						@if(auth()->user()["professor"] == 1 and auth()->user()["gestor"]==1)

							<div class="btn-group pull-left ">
								<p> </p>
								<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" >
									Gerir Sistema
								</button>
								<div class="dropdown-menu dropdown-menu-right">
									<li><a href="{{route('listar_alunos')}}"><strong>Listar Alunos</strong></a></li>
									<li><a href="{{route('listar_professores')}}"><strong>Listar Professores</strong></a></li>
									<li><a href="{{route('cronograma.listar_atividades_cronograma')}}"><strong>Gerir Cronograma</strong></a></li>
									<li><a href="{{route('listar_salas')}}"><strong>Gerir Salas</strong></a></li>
									<li><a href="{{route('gerir_semestres')}}"><strong>Gerir Semestres</strong></a></li>
									{{--<li><a href="{{route('incluir a rota do relatorio')}}"><strong>Gerir Relatório</strong></a></li>--}}
								</div>
							</div>
						@endif
						<li><a href="#">{{auth()->user()->nome}}</a></li> {{-- mostro o nome de quem está logado --}}
						<li><a href="{{route('site.login.sair')}}"><strong>Sair</strong></a></li> {{-- sai do login --}}
						@endif
				</ul>
			</div>
		</div>
	</nav>
	<!-- -->
	@yield('voltar')
	<main class='container'>

		<h1><strong>@yield('titulo')</strong></h1>
		<br><br>
		@yield('conteudo')
	</main>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootbox.min.js') }}"></script>

    
    
    
    
</body>
</html>
