<?php
namespace App\Http\Controllers;
<<<<<<< HEAD
=======

>>>>>>> ad31a14e2a3edb1e7e9c8c732d0467b15ef1beff
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
<<<<<<< HEAD
=======

>>>>>>> ad31a14e2a3edb1e7e9c8c732d0467b15ef1beff
    public function salvar_atividade_cronograma(Request $request){
        $campos = $request->all();
        $semestre = explode('-',$campos['semestre']);
        $id_cronograma = Semestre::where([
            ['ano', $semestre[0]],
            ['numero', $semestre[1]],
        ]);
        if($id_cronograma-> count() == 0){
            $registro = ["ano" => $semestre[0], "numero" => $semestre[1]];
            Semestre::create($registro);
        }
        else if($campos['data_inicio'] > $campos['data_fim']){
            $request->session()->flash('alert-danger', 'Data de Inicio é superior a Data de Fim');
            return redirect()->back();
        }
        else{
            $registro = [ "nome" => $campos['nome'],
                "data_inicio" => $campos['data_inicio'],
                "data_fim" => $campos['data_fim'],
                "semestre_ano" => $semestre[0],
                "semestre_numero" => $semestre[1],
                "turma" => $campos['turma'],
            ];
            Cronograma::create($registro);
            $request->session()->flash('alert-success', 'Cadastrado com sucesso!');
            return redirect()->route('listar_atividades_cronograma');
        }
<<<<<<< HEAD
        //no banco, semestre_ano, semestre_numero e turma deveriam ser chaves
=======
    //no banco, semestre_ano, semestre_numero e turma deveriam ser chaves

>>>>>>> ad31a14e2a3edb1e7e9c8c732d0467b15ef1beff
    }

    public function listar_atividades_cronograma(){
        $cronogramas = (Cronograma::select('id','nome','data_inicio','data_fim','semestre_ano','semestre_numero','turma'))->distinct()->get();
        $semestres = (Semestre::select('ano','numero')->distinct()->get());
        return view('professor.gestor.cadastro_cronograma', compact ('semestres'), compact('cronogramas'));
    }
<<<<<<< HEAD
=======

>>>>>>> ad31a14e2a3edb1e7e9c8c732d0467b15ef1beff
    public function deletar_atividade_cronograma(Request $request){
        $campos = $request->all();
        Cronograma::find($campos['Excluir'])->delete();
        return redirect()->route('listar_atividades_cronograma');
    }
<<<<<<< HEAD
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
=======

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

>>>>>>> ad31a14e2a3edb1e7e9c8c732d0467b15ef1beff
        return view("professor.visualizar_cronograma", compact('cronograma1'), compact('cronograma2'));
    }
}