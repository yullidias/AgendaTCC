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
					@yield('camposnavbar')
				</ul>
			</div>
		</div>
	</nav>
	<!-- -->

	<main class='container'>
		<h1><strong>@yield('titulo')</strong></h1>
		@yield('conteudo')
	</main>

	<!-- 
	<footer class='footer' align='right'>
	    <div>
	          <img src='logo.png' height='40px'>
	    </div>
    </footer>-->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>