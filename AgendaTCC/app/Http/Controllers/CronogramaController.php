<?php

namespace App\Http\Controllers;

use App\User;
use App\Semestre;
use App\Cronograma;
use App\Agendamento;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;


class CronogramaController extends Controller{

    public function salvar_atividade_cronograma(Request $request){
        $campos = $request->all();
        $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();
        if($semestre == null){
            $request->session()->flash('alert-danger', 'Não há semestre cadastrado');
            return redirect()->back();
        }
        else if($campos['data_inicio'] > $campos['data_fim']){
            $request->session()->flash('alert-danger', 'Data de Início é superior a Data de Fim');
            return redirect()->back();
        }
        else if($campos['data_inicio'] > $semestre->data_fim || $campos['data_inicio'] < $semestre->data_inicio ||
            $campos['data_fim'] > $semestre->data_fim || $campos['data_fim'] < $semestre->data_inicio){
            $request->session()->flash('alert-danger', 'A Data de Início e a Data de Fim devem pertencer semestre atual.');
            return redirect()->back();
        }
        else{
            $registro = [ "nome" => $campos['nome'],
                "data_inicio" => $campos['data_inicio'],
                "data_fim" => $campos['data_fim'],
                "semestre_ano" => $semestre->ano,
                "semestre_numero" => $semestre->numero,
                "turma" => $campos['turma'],
            ];
            Cronograma::create($registro);
            $request->session()->flash('alert-success', 'Cadastrado com sucesso!');
            return redirect()->route('listar_atividades_cronograma');
        }
    }

    public function listar_atividades_cronograma(){
        $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();
        $cronogramas = Cronograma::all();
        return view('professor.gestor.gerir_cronograma', compact('cronogramas'), compact('semestre'));
    }

    public function deletar_atividade_cronograma(Request $request){
        $campos = $request->all();
        Cronograma::find($campos['id'])->delete();
        $request->session()->flash('alert-success', 'Excluído!');
        return redirect()->route('listar_atividades_cronograma');
    }

    public function atualizar_atividade_cronograma(Request $request){
        $campos = $request->all();
        $chave = $campos['id'];
        if ($campos['data_inicio'] > $campos['data_fim']) {
            $request->session()->flash('alert-danger', 'Data de Início é superior a Data de Fim');
            return redirect()->back();
        }
        Cronograma::where("id",'=',"$chave")->update([
            'data_inicio' => $campos['data_inicio'],
            'data_fim' => $campos['data_fim']
        ]);
        $request->session()->flash('alert-success', 'Alterações salvas!');
        return redirect()->route('listar_atividades_cronograma');
    }

    public function aluno_visualizar_cronograma(){
        $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();//pega o semestre atual//
        $aluno = auth()->user(); //pega o usuario atual//

        $matriculaTCC2 = User::join('aluno_semestres','users.id','=','aluno_semestres.usuario_aluno')
            ->where([ ['users.id','=',"$aluno->id"], ['aluno_semestres.semestre_ano','=',"$semestre->ano"],
            ['aluno_semestres.semestre_numero','=',"$semestre->numero"], ['aluno_semestres.materia','=','2'], ])->get();


        if($matriculaTCC2->count()!=0){ //se tiver cursando o tcc2, o agendamento será mostrado//
            $show = true;
            $agendamento = Agendamento::where('id_matricula', '=', $matriculaTCC2[0]->id)->get()->first();
        }
        else{
            $show = false;
            $agendamento = '';
        }

        $cronograma1 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre->ano")->where('semestre_numero','=',"$semestre->numero")->where('turma', '=', '1')
            ->orderby('turma','asc','data_inicio','asc')->get();

        $cronograma2 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre->ano")->where('semestre_numero','=',"$semestre->numero")->where('turma', '=', '2')
            ->orderby('turma','asc','data_inicio','asc')->get();

        return view("aluno.visualizar_cronograma", compact('cronograma1','cronograma2','show', 'agendamento'));
    }

    public function professor_visualizar_cronograma(){
        $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();

        $cronograma1 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre->ano")->where('semestre_numero','=',"$semestre->numero")->where('turma', '=', '1')
            ->orderby('turma','asc','data_inicio','asc')->get();

        $cronograma2 = (Cronograma::select('nome','data_inicio','data_fim'))
            ->where('semestre_ano', '=', "$semestre->ano")->where('semestre_numero','=',"$semestre->numero")->where('turma', '=', '2')
            ->orderby('turma','asc','data_inicio','asc')->get();

        return view("professor.visualizar_cronograma", compact('cronograma1'), compact('cronograma2'));
    }
}
