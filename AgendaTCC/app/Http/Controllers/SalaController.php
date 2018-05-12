<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sala;

class SalaController extends Controller
{
    public function listar_salas(){
        $salas = Sala::all();
        return view('professor.gestor.gerir_sala', compact('salas'));
    }

    public function excluir_sala(Request $req){
        $sala_predio = explode('-',$req['Excluir']);
        Sala::where('sala', $sala_predio[0])->where('predio', $sala_predio[1])->delete();
        return redirect()->route('listar_salas');
    }

    public function salvar_sala(Request $req){
        if(Sala::where('sala', $req['sala'])->where('predio', $req['predio'])->count()){
            $req->session()->flash('alert-danger', 'Sala e Prédio já existem!');
            return redirect()->back();
        }
        else{
            Sala::create([
                "sala" => $req['sala'],
                "predio" => $req['predio'],
            ]);
            $req->session()->flash('alert-success', 'Cadastrado com sucesso!');
            return redirect()->route('listar_salas');
        }
    }
}
