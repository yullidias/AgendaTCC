<?php

namespace App\Http\Controllers;

use App\Semestre;
use Illuminate\Http\Request;


class SemestreController extends Controller{

    public function salvar_semestre(Request $request){
        $campos = $request->all();
        if ($campos['data_inicio'] > $campos['data_fim']) {
            $request->session()->flash('alert-danger', 'Data de Início é superior a Data de Fim');
            return redirect()->back();
        }
        else {
            $sem = Semestre::where([
                ['ano', $campos['ano']],
                ['numero', $campos['numero']],
            ]);
            if($sem->count() == 0) {
                $registro = [
                    "ano" => $campos['ano'],
                    "numero" => $campos['numero'],
                    "data_inicio" => $campos['data_inicio'],
                    "data_fim" => $campos['data_fim'],
                ];
                Semestre::create($registro);
                $request->session()->flash('alert-success', 'Cadastrado!');
            }
            else{
                $request->session()->flash('alert-danger', 'Semestre já existe');
            }
            return redirect()->route('gerir_semestres');
        }
    }

    public function listar_semestres(){
        $semestres = (Semestre::select('ano', 'numero', 'data_inicio', 'data_fim'))->distinct()->get();
        return view('professor.gestor.gerir_semestres', compact('semestres'));
    }

    public function excluir_semestre(Request $request){
        $campos = $request->all();
        $chaves = $campos['id'];
        $chaves = explode('-',$chaves);
        Semestre::where('ano', '=', "$chaves[0]")->where('numero','=',"$chaves[1]")->delete();
        $request->session()->flash('alert-success', 'Excluído!');
        return redirect()->route('gerir_semestres');
    }

    public function atualizar_semestre(Request $request){
        $campos = $request->all();
        $chaves = $campos['id'];
        $chaves = explode('-',$chaves);
        if ($campos['data_inicio'] > $campos['data_fim']) {
            $request->session()->flash('alert-danger', 'Data de Início é superior a Data de Fim');
            return redirect()->back();
        }
        Semestre::where('ano', '=', "$chaves[0]")->where('numero','=',"$chaves[1]")->update([
            'data_inicio' => $campos['data_inicio'],
            'data_fim' => $campos['data_fim']
        ]);
        $request->session()->flash('alert-success', 'Alterações salvas!');
        return redirect()->route('gerir_semestres');
    }
}