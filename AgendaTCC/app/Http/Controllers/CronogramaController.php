<?php

namespace App\Http\Controllers;

use App\Semestre;
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
        $semestre_ano = date ("Y"); //retorna o ano atual, no formato yyyy//
        $semestre_numero = (date ("m") <= 6)? 1 : 2;//retorna o numero do mes atual, descobre o semestre atual//

        $cronograma = Semestre::where([
            ['ano', $semestre_ano],
            ['numero', $semestre_numero],
        ]);
        if($cronograma-> count() == 0){//cria o semestre no banco de dados caso ele ainda não exista//
            $registro = ["ano" => $semestre_ano, "numero" => $semestre_numero];
            Semestre::create($registro);
        }
        if($semestre_numero==1){
            $min = $semestre_ano."-01-01";
            $max = $semestre_ano."-06-30";
        }
        else{
            $min = $semestre_ano."-07-01";
            $max = $semestre_ano."-12-31";
        }


        if($campos['data_inicio'] > $campos['data_fim']){
            $request->session()->flash('alert-danger', 'Data de Início é superior a Data de Fim');
            return redirect()->back();
        }
        else if($campos['data_inicio'] > $max || $campos['data_inicio'] < $min || $campos['data_fim'] > $max || $campos['data_fim'] < $min){
            $request->session()->flash('alert-danger', 'A Data de Início e a Data de Fim devem pertencer semestre atual.');
            return redirect()->back();
        }
        else{
            $registro = [ "nome" => $campos['nome'],
                "data_inicio" => $campos['data_inicio'],
                "data_fim" => $campos['data_fim'],
                "semestre_ano" => $semestre_ano,
                "semestre_numero" => $semestre_numero,
                "turma" => $campos['turma'],
            ];
            Cronograma::create($registro);
            $request->session()->flash('alert-success', 'Cadastrado com sucesso!');
            return redirect()->route('listar_atividades_cronograma');
        }
    //no banco, semestre_ano, semestre_numero e turma deveriam ser chaves
    }

    public function listar_atividades_cronograma(){
        $cronogramas = (Cronograma::select('id','nome','data_inicio','data_fim','semestre_ano','semestre_numero','turma'))->distinct()->get();
        return view('professor.gestor.cadastro_cronograma', compact('cronogramas'));
    }

    public function deletar_atividade_cronograma(Request $request){
        $campos = $request->all();
        Cronograma::find($campos['Excluir'])->delete();
        return redirect()->route('listar_atividades_cronograma');
    }

    public function aluno_visualizar_cronograma(){
        $semestre_ano = date ("Y"); //retorna o ano atual, no formato yyyy//
        $semestre_numero = (date ("m") <= 6)? 1 : 2;//retorna o numero do mes atual, descobre o semestre atual//

        $cronograma1 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre_ano")->where('semestre_numero','=',"$semestre_numero")->where('turma', '=', '1')
            ->orderby('turma','asc','data_inicio','asc')->get();

        $cronograma2 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre_ano")->where('semestre_numero','=',"$semestre_numero")->where('turma', '=', '2')
            ->orderby('turma','asc','data_inicio','asc')->get();

        return view("aluno.visualizar_cronograma", compact('cronograma1'), compact('cronograma2'));
    }

    public function professor_visualizar_cronograma(){
        $semestre_ano = date ("Y"); //retorna o ano atual, no formato yyyy//
        $semestre_numero = (date ("m") <= 6)? 1 : 2;//retorna o numero do mes atual, descobre o semestre atual//

        $cronograma1 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre_ano")->where('semestre_numero','=',"$semestre_numero")->where('turma', '=', '1')
            ->orderby('turma','asc','data_inicio','asc')->get();

        $cronograma2 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre_ano")->where('semestre_numero','=',"$semestre_numero")->where('turma', '=', '2')
            ->orderby('turma','asc','data_inicio','asc')->get();

        return view("professor.visualizar_cronograma", compact('cronograma1'), compact('cronograma2'));
    }
}
