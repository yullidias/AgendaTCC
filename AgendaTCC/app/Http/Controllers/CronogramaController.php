<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

use App\Cronograma;
use App\PassoCronograma;

class CronogramaController extends Controller
{

    public function cadastro(){
        $cronogramas = Cronograma::all();
        return view('professor.gestor.cadastro_cronograma', compact('cronogramas'));
    }

    public function salvar_atividade_cronograma(Request $request){
        $campos = $request->all();
        $semestre = explode('-',$campos['semestre']);
        $id_cronograma = Cronograma::where([
            ['semestre_ano', $semestre[0]],
            ['semestre_numero', $semestre[1]],
            ['turma', $campos['turma']],
        ])->first();
        echo $id_cronograma;
//no banco, semestre_ano, semestre_numero e turma deveriam ser chaves

        $registro = [ "nome" => $campos['nome'],
                    "data_inicio" => $campos['data_inicio'],
                    "data_fim" => $campos['data_fim'],
                    "cronograma_id" => $id_cronograma->id,
            ];
        PassoCronograma::create($registro);
        return redirect()->route('listar_atividades_cronograma');
    }

    public function listar_atividades_cronograma(){
        $atividades_cronograma = PassoCronograma::all();
        $cronogramas = (Cronograma::distinct('semestre_ano'))->get();
        return view('professor.gestor.cadastro_cronograma', compact('atividades_cronograma'), compact('cronogramas'));
    }

    public function deletar_atividade_cronograma(Request $request){
        $campos = $request->all();
        PassoCronograma::find($campos['Excluir'])->delete();

        return redirect()->route('listar_atividades_cronograma');
    }
}
