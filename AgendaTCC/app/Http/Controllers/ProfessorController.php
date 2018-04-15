<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Aluno;
use App\Semestre;
use App\AlunoSemestre;

class ProfessorController extends Controller
{
     //-----------------Gestor---------------------------
    public function pre_cadastro_aluno(){
    	return view('professor.gestor.pre_cadastro_aluno');
	}
	public function salvar_pre_cadastro_aluno(Request $req)
    {
      	$dados = $req->all();

     	$aluno['matricula'] = $dados['matricula'];
     	$aluno['nome'] = NULL;
     	$aluno['senha'] = NULL;
     	$aluno['email'] = NULL;

        $aluno_semestre['aluno_matricula'] = $dados['matricula'];
        $aluno_semestre['semestre_ano'] = intval(date("Y"));
        $aluno_semestre['semestre_numero'] = (date("m") < 06 )? 01: 02;
        $aluno_semestre['materia'] = intval($dados['materia']);
    
        if(DB::table('semestres')->where([
            ['ano','=',$aluno_semestre['semestre_ano']],
            ['numero','=', $aluno_semestre['semestre_numero']]])->count() == 0){

             DB::table('semestres')->insert(
                ['ano' => $aluno_semestre['semestre_ano'], 
                 'numero' => $aluno_semestre['semestre_numero'] ]);
        }
        DB::table('alunos')->insert($aluno); //Aluno::create($aluno);
        DB::table('aluno_semestres')->insert($aluno_semestre); //AlunoSemestre::create($aluno_semestre);
     	return redirect()->route('listar_alunos');

    }
    public function listar_alunos()
    {
     	echo "Listar";;

    }
    //-----------------Orientador---------------------------
    //-----------------Professor---------------------------
}
