<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\AlunoSemestre;
use App\Professor;
use App\Semestre;
use App\TccDados;
use App\User;
use App\Repositories\AlunoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{

    public function cadastro_aluno(){
        $professor = User::where([['professor','=',true]])->get();
        return view('aluno.cadastro_aluno',compact('professor'));
    }
    public function perfil_aluno(){
        $aluno = User::where([['professor','=',false]])->get();
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
            'id' => $dados['id'],
            'nome' => $dados['nome'],
            'password' => bcrypt($dados['password']),
            'email' => $dados['email']
        ];
        $orientador = User::where( [['nome','=',$dados['orientador']]])->get()->first();
        $tccDados = [
            'idDados' => NULL,
            'tema' => $dados['tema'],
            'orientador' => $orientador['id'],
            'usuario_aluno' => $dados['id'],
            'coorientador' => $dados['coorientador']
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


           if( User::where( [['id','=',$aluno['id']]])->update([
                'nome' => $aluno['nome'],
                'password' => $aluno['password'],
                'email' => $aluno['email']
            ])) {
               TccDados::create($tccDados);
               AlunoSemestre::where( [['usuario_aluno','=',$aluno['id']]])->update([
                   'materia' => intval($dados['materia'])

               ]);
               $request->session()->flash('alert-success', 'Aluno cadastrado com sucesso!');
               return redirect()->route('perfil_aluno');
           }else{
               $request->session()->flash('alert-danger', 'Não foi possível cadastrar o aluno!');
               return redirect()->back();
           }



    }
}
