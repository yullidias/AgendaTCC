@extends('layout')

@section('titulo','Visualizar Professor')

@section('voltar')
<a href="{{ route('listar_professores') }}"><spa class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection


@section('conteudo')


<div class='col-md-6 col-md-offset-1'>
    <form>
        {{ csrf_field() }}
        <div class="form-group">
            <label>Nome</label>
            <input type='text' class='form-control' name='nome' value="{{$professor->nome}}" readonly><br>

            <label>SIAPE</label>
            <input type='text' class='form-control' name='id' value="{{$professor->id}}" readonly><br>

            <label>E-mail</label>
            <input type='text' class='form-control' name='email' value="{{$professor->email}}" readonly><br>

            
        </div>
    </form>
</div>
@endsection