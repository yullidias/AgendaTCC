<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aluno;
use App\Semestre;
use App\AlunoSemestre;
use App\Professor;

class ProfessorController extends Controller
{
       //-----------------Gestor---------------------------
  public function listar_alunos()
  {
    echo "Listar Aluno";
  }

  public function pre_cadastro_aluno(){
        return view('professor.gestor.pre_cadastro_aluno');
    }

    public function salvar_pre_cadastro_aluno(Request $req)
    {
        $this->validate($req, [
            'matricula' => 'required|unique:alunos',
        ]);

        $dados = $req->all();

        $aluno = [
            'matricula' => $dados['matricula'],
            'nome' => NULL,
            'senha' => NULL,
            'email' => NULL
        ];

        $semestre = [
            'ano' => intval(date("Y")),
            'numero'  => (date("m") < 06 )? 01: 02
        ];

        $alunoSemestre = [
            'aluno_matricula' => $dados['matricula'],
            'semestre_ano' => intval(date("Y")),
            'semestre_numero' => (date("m") < 06 )? 01: 02,
            'materia' => intval($dados['materia'])
        ];

        if(Semestre::where([
                ['ano','=', $semestre['ano'] ],
                ['numero','=', $semestre['numero'] ]
            ])->count() == 0){

            Semestre::create($semestre);
        }

        Aluno::create($aluno);
        AlunoSemestre::create($alunoSemestre);

        return redirect()->route('listar_alunos');
    }

    public function listar_professores()
    {
      echo "Listar Professor";
    }
    public function pre_cadastro_professor(){
        return view('professor.gestor.pre_cadastro_professor');
    }

    public function salvar_pre_cadastro_professor(Request $req)
    {
        $this->validate($req, [
            'SIAPE' => 'required|unique:professors',
        ]);

        $dados = $req->all();

        if(isset($_POST['permissao_orientador'])){
            $permissao = $dados['permissao_orientador'];
        }else{
            $permissao = "0";
        }

        if(isset($_POST['permissao_professorDisciplina'])){
            $permissao = $permissao.$dados['permissao_professorDisciplina'];
        }else{
            $permissao = $permissao."0";
        }

        if(isset($_POST['permissao_gestor'])){
            $permissao = $permissao.$dados['permissao_gestor'];
        }else{
            $permissao = $permissao."0";
        }

        $professor = [
            'SIAPE' => $dados['SIAPE'],
            'nome' => NULL,
            'senha' => NULL,
            'permissao' => intval($permissao),
            'email' => NULL,
            'excluido' => false
        ];

        Professor::create($professor);

        return redirect()->route('listar_professores');

    }
    //-----------------Orientador---------------------------
    //-----------------Professor---------------------------

	public function cadastro_professor(){
        return view('professor.cadastro_professor');
    }
    public function perfil_professor(){
        $professor = Professor::get();

        return view('professor.perfil_professor', compact('professor'));
    }
    public function solicitar_alteracao(){
        echo "altera dados";
    }

    public function salvar_cadastro_professor(Request $request){
        $dados = $request->all();

        $professor = [
            'SIAPE' => $dados['SIAPE'],
            'nome' => $dados['nome'],
            'senha' => $dados['senha'],
            'email' => $dados['email']
        ];

	if(Professor::where( [['SIAPE','=',$professor['SIAPE']]])){
           Professor::where( [['SIAPE','=',$professor['SIAPE']]])->update([
                'nome' => $professor['nome'],
                'senha' => $professor['senha'],
                'email' => $professor['email']
            ]);
               
           }


        return redirect()->route('perfil_professor');



    }
}
