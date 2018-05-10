@extends('layout')

@section('titulo','Alterar Professor')

@section('voltar')
<a href="{{ route('listar_professores') }}"><spa class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection


@section('conteudo')


<div class='col-md-6 col-md-offset-1'>
    <form action="{{ route('listar_professores.alterar_professor.salvar_alterar_professor') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            @if(isset($professor->nome))
                <label>Nome</label>
                <input type='text' class='form-control' name='nome' value="{{$professor->nome}}" readonly ><br>
            @endif

            <label>Matricula</label>
            <input type='text' class='form-control' name='id' value="{{$professor->id}}" readonly><br>

            @if(isset($professor->email)) 
                <label>E-mail</label>
                <input type='text' class='form-control' name='email' value="{{$professor->email}}" readonly><br>
            @endif
            <br><label>Permissões Atuais:</label>
            <div type='text' class='form-control {{$professor->orientador}} '   readonly style="display:none;">Orientador<br></div>
            <div type='text' class='form-control {{$professor->professorDisciplina}}'  readonly style="display:none;">Professor da Disciplina<br></div>
            <div type='text' class='form-control {{$professor->gestor}} '   readonly style="display:none;">Gestor<br></div>
            <br><label>Selecione as novas Permissões*:</label>
		  <div class="checkbox">
		  <label>
		    <input type="checkbox" name="permissao_orientador" value="1" onclick="bloqueio()" id="per1" > Orientador
		  </label>

		  <label>
		    <input type="checkbox" name="permissao_professorDisciplina" value="1" onclick="bloqueio()" id="per2"> Professor da Disciplina
		  </label>

		  <label>
		    <input type="checkbox" name="permissao_gestor" value="1" onclick="bloqueio()" id="per3"> Gestor
		  </label>
		</div>
            
        </div>

        <br><input type='submit' class='btn btn-default' id="botao" value='Alterar' style="display:none;">
            
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
<br><div>*Pelo menos uma opção deve ser selecionada</div>
         <script language="javascript" type="text/javascript">
           function bloqueio(){
                var per1=document.getElementById("per1");
                var per2=document.getElementById("per2");
                var per3=document.getElementById("per3");
                var botao=document.getElementById("botao");
                if((per1.checked||per2.checked||per3.checked)){
                    botao.style.display = 'block';
                }else{
                    botao.style.display = 'none';
                }
            }
        </script>
    </form>
</div>
@endsection