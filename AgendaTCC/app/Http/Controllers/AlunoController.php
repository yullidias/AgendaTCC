<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\AlunoSemestre;
use App\Professor;
use App\TccDados;
use App\Repositories\AlunoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{

    public function cadastro_aluno(){
        $professor = Professor::get();
        return view('aluno.cadastro_aluno',compact('professor'));
    }
    public function perfil_aluno(){
        $aluno = Aluno::get();
        $tccDados = TccDados::get();
        $alunoSemestre = AlunoSemestre::get();

        return view('aluno.perfil_aluno', compact('tccDados','aluno','alunoSemestre'));
    }
    public function solicitar_alteracao(){
        echo "altera dados";
    }

    public function salvar_cadastro_aluno(Request $request){
        $dados = $request->all();

        $aluno = [
            'matricula' => $dados['matricula'],
            'nome' => $dados['nome'],
            'senha' => $dados['senha'],
            'email' => $dados['email']
        ];

        $tccDados = [
            'idDados' => NULL,
            'tema' => $dados['tema'],
            'orientador' => $dados['orientador'],
            'aluno_matricula' => $dados['matricula'],
            'coorientador' => $dados['coorientador']
        ];

           if( Aluno::where( [['matricula','=',$aluno['matricula']]])->update([
                'nome' => $aluno['nome'],
                'senha' => $aluno['senha'],
                'email' => $aluno['email']
            ])) {
               TccDados::create($tccDados);
               $request->session()->flash('alert-success', 'Aluno cadastrado com sucesso!');
               return redirect()->route('perfil_aluno');
           }else{
               $request->session()->flash('alert-danger', 'Não foi possível cadastrar o aluno!');
               return redirect()->back();
           }



    }
}
