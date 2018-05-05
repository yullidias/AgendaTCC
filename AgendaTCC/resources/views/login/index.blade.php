@extends('layout')
@section('conteudo')


    <div class="row text-center">

        <img src="chapeu.png" alt="Smiley face" width="300" height="200">
        <br>
        <h1 left>Agenda TCC</h1>
        <br>
        <form class="form-group" action="{{route('site.login.entrar')}}" method="post">
            {{csrf_field()}}

            <div class="input-field ">
                <label><h4> Login</h4></label>
                <input type="text" name="login">
            </div>
            <p></p>
            <div class="input-field">
                <label><h4>Senha</h4></label>
                <input type="password" name="password">
            </div>
            <p></p>
            <button class="btn #D3D3D3 center" >Entrar</button>
        </form>
    </div>

@endsection