@extends('layout')

@section('titulo','Pré Cadastro Professor')

@section('voltar')
<a href="{{ route('listar_professores') }}"><spa class="glyphicon glyphicon-arrow-left voltar"></span></a>
@endsection

@section('camposnavbar')
<li><a href="{{ route('listar_professores') }}">Prefessor</a></li>
@endsection

@section('conteudo')
<div class='col-md-4 col-md-offset-1'>
    
	<form action="{{ route('listar_professores.pre_cadastro_professor.salvar_pre_cadastro_professor') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
			<label>SIAPE*</label>
			<input type='text' class='form-control' name='id' required nclick="bloqueio()" id="siape" onkeydown="bloqueio()" onclick="bloqueio()" >
			<span class="text-danger">{{ $errors->has('id') ? 'SIAPE já cadastrado! Tente novamente' : ''}}</span>
		</div>

		<br><label>Permissão**</label>
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
	   
			
		<br><input type='submit' class='btn btn-default' value='Cadastrar' id="botao" style="display:none;">
      <br><div>*Campo Obrigatório</div>
        <br><div>**Pelo menos uma opção deve ser selecionada</div>
         <script language="javascript" type="text/javascript">
           function bloqueio(){
                var siape=document.getElementById("siape");
                var per1=document.getElementById("per1");
                var per2=document.getElementById("per2");
                var per3=document.getElementById("per3");
                var botao=document.getElementById("botao");
                if((per1.checked||per2.checked||per3.checked)&&siape.value!=""){
                    botao.style.display = 'block';
                }else{
                    botao.style.display = 'none';
                }
            }
        </script>
        
	</form>
     
</div>
@endsection