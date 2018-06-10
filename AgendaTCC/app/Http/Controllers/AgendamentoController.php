<?php

namespace App\Http\Controllers;

use App\AlunoSemestre;
use App\LogAgendamento;
use App\Agendamento;
use App\Semestre;
use App\Sala;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class AgendamentoController extends Controller
{
    public function salvar_agendamento(Request $request){
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
            $request->session()->flash('alert-success', 'Salvo!');
            $request->session()->flash('alert-success','Obs: O sistema não se responsabiliza por eventuais indisponibilidades de salas e conflitos nos horários de agendamento, uma vez que os conflitos identificáveis são baseados nos agendamentos realizados no sistema e que não há integração com o sistema de agendamento de salas do CEFET.');
            return redirect()->route('ver_agendamento');
        }
    }

    public function ver_agendamento($id){//recebe a id do aluno, passa o agendamento atual e os logs//
        $salas = Sala::orderBy('predio')->get();
        $professores = User::where('professor', '=', "1")->get();
        $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();//semestre atual//

        $id_orientador = Auth()->user()->id;
        $matricula = AlunoSemestre::where([ ['usuario_aluno', '=', $id],
            ['semestre_ano', '=', $semestre->ano], ['semestre_numero', '=', $semestre->numero], ['materia', '=', "2"], ])->get()->first();

        $agendamento = Agendamento::where('id_matricula', '=', $matricula->id)->get()->first();

        $logs = LogAgendamento::where([ ['id_matricula', '=', $matricula->id], ['id_orientador', '=', $id_orientador], ])->get();

        return view('professor.visualizar_agendamento', compact('matricula', 'salas', 'semestre', 'professores', 'agendamento', 'logs'));
    }

}
