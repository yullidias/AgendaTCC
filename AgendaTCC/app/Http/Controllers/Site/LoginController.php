<?php

namespace App\Http\Controllers\Site;

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
            if($usuarioLogado['professor']){
                if($usuarioLogado['gestor']) {
                    return redirect()->route('cadastrar_professor');
                }
            }
        }
        else {
            $req->session()->flash('alert-danger', 'Usuário ou senha incorretos!');
            return redirect()->back();
        }
    }

    public function sair()
    {
        Auth::logout();
        return redirect()->route('site.login');
    }

}
