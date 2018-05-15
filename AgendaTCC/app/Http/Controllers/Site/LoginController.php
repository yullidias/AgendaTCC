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
        $this->validate($req, [
           'login' => 'required|numeric|exists:users,id',
            'password'=> 'required',
        ],[
            'login.required' => 'O campo login é obrigatório!',
            'login.numeric' => 'Digite a Matrícula ou SIAPE!',
            'login.exists' => 'Usuário não cadastrado!',
            'password.required' => 'O campo senha é obrigatório!',
        ]);

        if(Auth::attempt(['id'=>$dados['login'],'password'=>$dados['password']])){
            $usuarioLogado = auth()->user();
//            dd($usuarioLogado);
            if($usuarioLogado['professor']==1){
                return redirect()->route('perfil_professor');
            }else if($usuarioLogado['professor']==0){
                 // dd("Tela em construção");
                return redirect()->route('cadastrar_aluno');
            }
        }
        else{
            $req->session()->flash('alert-danger', 'Login ou senha incorretos');
            return redirect()->route('site.login');
        }

    }

    public function sair()
    {
        Auth::logout();
        return redirect()->route('site.login');
    }

}
