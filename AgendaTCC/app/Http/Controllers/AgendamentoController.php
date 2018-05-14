<?php

namespace App\Http\Controllers;

use App\Semestre;
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
            return redirect()->route('listar_agendamento_logs');
        }
    }


    public function listar_agendamento_logs(Resquest $request){//passa o agendamento atual e os logs//
        $orientador = auth()->user(); //pega o usuario atual//
        $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();//semestre atual//
        $salas = Sala::all();


       // $sgendamento =
        $cronogramas = Cronograma::all();
        return view('professor.visualizar_agendamento', compact('salas'), compact('semestre'));
    }

}
