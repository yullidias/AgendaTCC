@extends('layout')
@section('conteudo')
    <div class="col-sm-20 col-xs-offset-10">
        <p><a class="btn btn-default pull-right" href="{{ route('cadastrar_aluno') }}" role="button" style="width: 150px">Cadastrar aluno    </a></p>
        <br>
        <br>
        <p><a class="btn btn-default pull-right" href="{{ route('cadastrar_professor') }}" role="button" style="width: 150px">Cadastrar professor</a></p>

    </div>
    <br>
    <br>
    <div class="row text-center">


        <img src="chapeu.png" alt="Smiley face" width="300" height="200">
        <br>
        <h1 left>Agenda TCC</h1>
        <br>

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

            <div class="text-danger">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    <ul>
                        @if(Session::has('alert-' . $msg))
                            <li class="text-danger-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</li>
                        @endif
                    </ul>

                @endforeach
            </div>


            <button class="btn #D3D3D3 center" >Entrar</button>
        </form>
    </div>

@endsection