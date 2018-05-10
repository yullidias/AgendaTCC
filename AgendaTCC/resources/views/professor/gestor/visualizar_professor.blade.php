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
             
            <br><label>Permissão</label>
            <div type='text' class='form-control {{$professor->orientador}} ' id="per1"  readonly style="display:none;">Orientador<br></div>
            <div type='text' class='form-control {{$professor->professorDisciplina}}' id="per2"   readonly style="display:none;">Professor da Disciplina<br></div>
            <div type='text' class='form-control {{$professor->gestor}} ' id="per3"  readonly style="display:none;">Gestor<br></div>
            
        
            
        </div>
        <script language="javascript" type="text/javascript">
            
            document.addEventListener("DOMContentLoaded", function(){
                start();
                });
       function start(){
                var permissoes=document.getElementsByClassName("1");
           if(permissoes.length==1){
               permissoes[0].style.display="block";
               console.log("1");
           }
           else if(permissoes.length==2){
               permissoes[0].style.display="block";
               permissoes[1].style.display="block";
               
               console.log("2");
           }
          else if(permissoes.length==3){
              permissoes[0].style.display="block";
               permissoes[1].style.display="block";
               permissoes[2].style.display="block";
               console.log("3");
           }
                  };
        </script>

        
        
    </form>
</div>
@endsection