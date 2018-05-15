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
