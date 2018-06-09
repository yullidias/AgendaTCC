@extends('layout')

@section('conteudo')

@section('titulo','Listar Professores')

<a class="btn btn-success pull-right" href="{{ route('listar_professores.pre_cadastro_professor') }}" role="button">Pré-cadastro professores</a>
<div class='col-md-offset-1'>
    <br><br>
    <br><br>
    <table class="table table-hover tabela">
        <thead>
            <tr>
                <th>SIAPE</th>
                <th>Nome</th>
                <th>Visualizar perfil</th>
                <th>Alterar permissões</th>
                <th>Excluir SIAPE</th>
            </tr>   
        </thead>
        <tbody>

            @foreach($professores as $professor)
            <tr>
                <td>{{$professor->id}}</td>
                <td>{{$professor->nome}}</td>
                <td><a class="btn btn-info" href="{{ route('listar_professores.visualizar_professor',['id' => $professor->id]) }}" role="button">Visualizar</a></td>
                <td><a class="btn btn-primary" href="{{ route('listar_professores.alterar_professor',['id' => $professor->id]) }}" role="button">Alterar</a></td>
                <td><a class="btn btn-danger" href="{{ route('listar_professores.excluir_professor',['id' => $professor->id]) }}" role="button" onclick="return confirm('Tem certeza que quer deletar?');">Excluir</a></td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<script>

</script>
@endsection