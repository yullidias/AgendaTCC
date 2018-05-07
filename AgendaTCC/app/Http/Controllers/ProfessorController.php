<?php

namespace App\Http\Controllers;

use App\TccDados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Semestre;
use App\AlunoSemestre;
use Illuminate\Support\Facades\Input;

class ProfessorController extends Controller
{
  //-----------------Gestor-------------------------------------------------------------
  //------------------------------------------------------------------------------------
  //Tela gestor tela22 precadastro aluno
    public function pre_cadastro_aluno(){
        return view('professor.gestor.pre_cadastro_aluno');
    }

    public function salvar_pre_cadastro_aluno(Request $req)
    {
        $this->validate($req, [
            'id' => 'required|unique:users|max:12',
        ],[
                'id.required' => 'Este campo é obrigatorio!',
                'id.unique' => 'Matricula já cadastrada!',
                'id.max' => 'Matricula deve ter no maximo 12 digitos!',
        ]);

        $dados = $req->all();

        $aluno = [
            'id' => $dados['id'],
            'nome' => NULL,
            'password' => bcrypt($dados['id']),
            'email' => NULL,
            'excluido' => false,
            'professor' => false,
            'orientador' =>  false,
            'professorDisciplina' => false,
            'gestor' => false,
        ];

        $semestre = Semestre::orderBy('ano', 'desc')
                    ->orderBy('numero', 'desc')
                    ->get()->first();

        $alunoSemestre = [
            'usuario_aluno' => $dados['id'],
            'semestre_ano' => $semestre['ano'],
            'semestre_numero' => $semestre['numero'],
            'materia' => intval($dados['materia'])
        ];


        User::create($aluno);
        AlunoSemestre::create($alunoSemestre);

        return redirect()->route('listar_alunos');
    }
    //------------------------------------------------------------------------------------
    //Tela gestor tela21 listadealunos
    public function listar_alunos(Request $req)
    {
        $dados = $req->all();

        $semestres = Semestre::all();

         if(isset($_POST['materia'])){

            $semestre=explode('-', $dados['semestre']);

            $materia_selecionada=$dados['materia'];
            $semestre_selecionado=$dados['semestre'];
            $semestre_ano=$semestre[1];
            $semestre_numero=$semestre[0];

        }else{ //primeira vez

            $semestre = Semestre::orderBy('ano', 'desc')
                    ->orderBy('numero', 'desc')
                    ->get()->first();

            $materia_selecionada=1;
            $semestre_selecionado=$semestre['numero'].'-'.$semestre['ano'];
            $semestre_ano=$semestre['ano'];
            $semestre_numero=$semestre['numero'];
        }

        $alunos = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')->where([
                ['aluno_semestres.materia', '=', $materia_selecionada],
                ['aluno_semestres.semestre_ano', '=', $semestre_ano],
                ['aluno_semestres.semestre_numero', '=', $semestre_numero],
                ['users.professor', '=',  false],
                ['users.excluido', '=',  false],
            ])->get();

        return view('professor.gestor.listar_alunos',compact('alunos','semestres','materia_selecionada','semestre_selecionado'));
    }
    //------------------------------------------------------------------------------------
    //Tela gestor tela23 alteracaocadastroaluno
    public function alterar_aluno($id)
    {

        if(TccDados::where('usuario_aluno','=',$id)->count() > 0){ //esta cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
            ->join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
            ->where('users.id', '=',  $id)->get()->first();
        }else { //esta so pre cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
            ->where('users.id', '=',  $id)->get()->first();
        }

        return view('professor.gestor.alterar_aluno',compact('aluno'));
    }

    public function salvar_alterar_aluno(Request $req)
    {
        $dados = $req->all();

        User::where('id','=',$dados['id'])
        ->update([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
        ]);

        AlunoSemestre::where('usuario_aluno','=',$dados['id'])
        ->update([
            'materia' => $dados['materia']
        ]);

        /*TccDados::where('usuario_aluno','=',$dados['id'])
        ->update([
            'tema' => $dados['tema'],
            'orientador' => $dados['orientador'],
            'coorientador' => $dados['coorientador']
        ]);*/

        return redirect()->route('listar_alunos');
    }

    //------------------------------------------------------------------------------------
    //Tela gestor tela24 dadoscadastraisaluno
     public function visualizar_aluno($id)
    {

        if(TccDados::where('usuario_aluno','=',$id)->count() > 0){ //esta cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
            ->join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
            ->where('users.id', '=',  $id)->get()->first();
        }else { //esta so pre cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
           ->where('users.id', '=',  $id)->get()->first();
        }

        return view('professor.gestor.visualizar_aluno',compact('aluno'));
    }

    //------------------------------------------------------------------------------------
    //Tela gestor excluiraluno
     public function excluir_aluno($id)
    {

         User::where('id','=',$id)
        ->update([
            'excluido' => true,
        ]);

         return redirect()->route('listar_alunos');
    }

    //------------------------------------------------------------------------------------
    //Tela gestor tela19 listaprofessorescadastrados
    public function listar_professores(Request $req)
    {
        $usuarioID=Auth()->user()->id;
        $professores = User::where('excluido',false)->where('professor',true)->where('id','!=',$usuarioID)->get();  
        return view('professor.gestor.listar_professores',compact('professores'));
    }
//------------------------------------------------------------------------------------
 // Tela gestor tela20 dadoscadastraisprofessor
     public function visualizar_professor($id)
    {
        $professor =User::where('id','=',$id)->get()->first();
        return view('professor.gestor.visualizar_professor',compact('professor'));
    }

    //------------------------------------------------------------------------------------
    //Tela gestor  excluir professor
      public function excluir_professor($id)
    {
         User::where('id','=',$id) ->update([
            'excluido' => true,
        ]);
          //verificar se nao esta se excluindo
         return redirect()->route('listar_professores');
    }

    //------------------------------------------------------------------------------------
    //Tela gestor tela29 precadastroprofessor
    public function pre_cadastro_professor(){
        return view('professor.gestor.pre_cadastro_professor');
    }
    public function salvar_pre_cadastro_professor(Request $req)
    {
      
        $dados = $req->all();

         $this->validate($req, [
            'id' => 'required|unique:users',
        ]);

        if(isset($_POST['permissao_orientador'])){
            $dados['permissao_orientador'] = true;
        }else{
            $dados['permissao_orientador']  = false;
        }

        if(isset($_POST['permissao_professorDisciplina'])){
            $dados['permissao_professorDisciplina'] = true;
        }else{
            $dados['permissao_professorDisciplina'] = false;
        }

        if(isset($_POST['permissao_gestor'])){
            $dados['permissao_gestor'] = true;
        }else{
            $dados['permissao_gestor'] = false;
        }

        $professor = [
            'id' => $dados['id'],
            'nome' => NULL,
            'password' => bcrypt($dados['id']),
            'email' => NULL,
            'excluido' => false,
            'professor' => true,
            'orientador' =>  $dados['permissao_orientador'],
            'professorDisciplina' =>  $dados['permissao_professorDisciplina'],
            'gestor' => $dados['permissao_gestor'],
        ];
        User::create($professor);

        return redirect()->route('listar_professores');
    }
    //-----------------Orientador---------------------------
    //-----------------Professor---------------------------

	public function cadastro_professor(){
        return view('professor.cadastro_professor');
    }
    public function perfil_professor(){
        $professor = User::where([['professor','=',true]])->get();

        return view('professor.perfil_professor', compact('professor'));
    }
    public function solicitar_alteracao(){
        echo "altera dados";
    }

    public function salvar_cadastro_professor(Request $request){
        $dados = $request->all();

        $professor = [
            'id' => $dados['id'],
            'nome' => $dados['nome'],
            'password' => $dados['password'],
            'email' => $dados['email']
        ];


          if(User::where( [['id','=',$professor['id']]])->update([
                'nome' => $professor['nome'],
                'password' => $professor['password'],
                'email' => $professor['email']
            ])){
                $request->session()->flash('alert-success', 'Professor cadastrado com sucesso!');
                return redirect()->route('perfil_professor');
           }else{
                $request->session()->flash('alert-danger', 'Não foi possível cadastrar o professor!');
                return redirect()->back();
	    }

    }

    public function visualizar_lista_alunos(Request $request){
        $dados = $request->all();
      $tccDados = TccDados::where([
          //alterar depois para pegar cada professor que estiver logado
          ['orientador' ,'=', '11111']
      ])->get();
        return view('professor.visualizar_lista_aluno', compact('tccDados'));
    }

    public function visualiza_ou_avalia_aluno(){
      if(Input::get('perfil')) {
          $aluno = User::where([['professor','=',false]])->get();
          $tccDados = TccDados::get();
          return view('professor.visualizar_aluno', compact('aluno','tccDados'));
      }
      else{
          return view('professor.avaliar_aluno');
      }
    }

    public function salvar_avaliacao(Request $request){
        $dados = $request->all();

        return redirect()->route('visualizar_aluno');
    }

}
