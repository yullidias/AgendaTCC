@extends('layout')
@section('conteudo')

    <div class="col-sm-20 col-xs-offset-10">
        <p><a class="btn btn-default pull-right" href="{{ route('cadastrar_aluno') }}" role="button" style="width: 150px">Cadastrar aluno    </a></p>
        <br>
        <p><a class="btn btn-default pull-right" href="{{ route('cadastrar_professor') }}" role="button" style="width: 150px">Cadastrar professor</a></p>

    </div>
   <br><br>
    <div class="row text-center">


        <img src="chapeu.png" alt="Smiley face" width="300" height="200" align="middle">
        <br>
        <h1 left>Agenda TCC</h1>


        <form class="form-group" action="{{route('site.login.entrar')}}" method="post">
            {{csrf_field()}}

            <div class="input-field {{ $errors->has('id') ? 'has-error' : '' }}">
                <label><h4>Login</h4></label>
                <input type="text" name="login">
            </div>

            <p></p>
            <div class="input-field {{ $errors->has('password') ? 'has-error' : '' }}">
                <label><h4>Senha</h4></label>
                <input type="password" name="password">
            </div>
            <p></p>
            @if(count($errors) > 0)
                <div class="text-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

         <button class="btn #D3D3D3 center" >Entrar</button>
        </form>
    </div>

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>

@endsection