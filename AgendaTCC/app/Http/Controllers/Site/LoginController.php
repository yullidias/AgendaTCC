<?php

namespace App\Http\Controllers\Site;

use App\Professor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;


class LoginController extends Controller
{
  // public function id()
  //     {
  //         return 'login'; //o padrao é usar o campo de email para autenticação, aqui alteramos para usar o campo login como autenticação
  //     }


    public function index()
    {
        return view('login.index');
    }

    public function entrar(Request $req)
    {

        $dados = $req->all();
        // dd($dados);
        if(Auth::attempt(['id'=>$dados['login'],'password'=>$dados['password']])){
            $usuarioLogado = auth()->user();
//            dd($usuarioLogado);
            if($usuarioLogado['professor']==1){

                if($usuarioLogado['gestor']==1) {
                    return redirect()->route('listar_alunos');

                }else if($usuarioLogado['orientador']==1){

                    dd("eu sou o orientador, minha pagina esta em construcao.");

                }else if($usuarioLogado['professorDisciplina']==1){
                    return redirect()->route('perfil_professor');
                }
            }else if($usuarioLogado['professor']==0){
                 // dd("Tela em construção");
                return redirect()->route('cadastrar_aluno');
            }
        }

    }

    public function sair()
    {
        Auth::logout();
        return redirect()->route('site.login');
    }

}
