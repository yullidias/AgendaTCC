<?php

namespace App\Http\Controllers;

use App\Semestre;
use Illuminate\Http\Request;


class SemestreController extends Controller
{
    public function salvar_semestre(Request $request){
        $campos = $request->all();

        if ($campos['data_inicio'] > $campos['data_fim']) {
            $request->session()->flash('alert-danger', 'Data de Início é superior a Data de Fim');
            return redirect()->back();
        }
        else {
            $registro = [
                "ano" => $campos['ano'],
                "numero" => $campos['numero'],
                "data_inicio" => $campos['data_inicio'],
                "data_fim" => $campos['data_fim'],

            ];
            $sem = Semestre::where([
                ['ano', $campos['ano']],
                ['numero', $campos['numero']],
            ]);

            if($sem-> count() == 0) {
                Semestre::create($registro);
                $request->session()->flash('alert-success', 'Cadastrado com sucesso!');
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
        $chaves = $campos['Excluir'];
        $chaves = explode('-',$chaves);
        Semestre::where('ano', '=', "$chaves[0]")->where('numero','=',"$chaves[1]")->delete();
        return redirect()->route('gerir_semestres');
    }

}