<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\TccDados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    public function cadastro_aluno(){
        return view('aluno.cadastro_aluno');
    }
    public function perfil_aluno(){
        echo "Perfil";
    }

    public function salvar_cadastro_aluno(Request $request){
        $dados = $request->all();

        $aluno['matricula'] = $dados['matricula'];
        $aluno['nome'] = $dados['nome'];
        $aluno['senha'] = $dados['senha'];
        $aluno['email'] = $dados['email'];

        $tccDados['tema'] = $dados['tema'];
        $tccDados['orientador'] = $dados['orientador'];
        $tccDados['aluno_matricula'] = $dados['matricula'];
        $tccDados['coorientador'] = $dados['coorientador'];


        DB::table('alunos')
            ->where('matricula', '=', $aluno['matricula'])
            ->update([
                'nome' => $aluno['nome'],
                'senha' => $aluno['senha'],
                'email' => $aluno['email']
            ]);
        DB::table('tcc_dados')->insert($tccDados);
        return redirect()->route('perfil_aluno');

    }
}
