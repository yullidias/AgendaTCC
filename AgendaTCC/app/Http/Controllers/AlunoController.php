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

        $aluno = new Aluno([
            'matricula' => $dados['matricula'],
            'nome' => $dados['nome'],
            'senha' => $dados['senha'],
            'email' => $dados['email']
        ]);

        $tccDados = new TccDados([
            'idDados' => NULL,
            'tema' => $dados['tema'],
            'orientador' => $dados['orientador'],
            'aluno_matricula' => $dados['matricula'],
            'coorientador' => $dados['coorientador']
        ]);

        if($aluno->existir()){
            $aluno->alterar();
            $tccDados->inserir();
        }

        return redirect()->route('perfil_aluno');

    }
}
