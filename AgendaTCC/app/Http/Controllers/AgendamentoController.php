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
    public function salvar_agendamento(Request $request, $id){
        $campos = $request->all();
        $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();
        if($semestre == null){
            $request->session()->flash('alert-danger', 'Não há semestre cadastrado');
            return redirect()->back();
        }
        else if($campos['data'] > $semestre->data_fim || $campos['data'] < $semestre->data_inicio){
            $request->session()->flash('alert-danger', 'A Data de Início e a Data de Fim devem pertencer semestre atual.');
            return redirect()->back();
        }
        /*else if(){//verifica disponibilidade da sala

        }*/
        else { //verifica se existe e cria/atualiza//
            $semestre = Semestre::orderBy('ano', 'desc', 'numero', 'desc')->first();//semestre atual//

            $matricula = AlunoSemestre::where([['usuario_aluno', '=', $id],
                ['semestre_ano', '=', $semestre->ano], ['semestre_numero', '=', $semestre->numero], ['materia', '=', "2"],])->get()->first();
            $agendamento = Agendamento::where('id_matricula', '=', $matricula->id)->get()->first();

            $data = $campos['data']." ".$campos['horario'];
            $array = explode('-', $campos['sala']);
            $sala = substr($array[1], 6, strlen($array[1])-6);
            $predio = substr($array[0], 8,strlen($array[0])-9);

            if ($agendamento) {//se existe, atualiza
                Agendamento::where("id_matricula",'=',"$matricula->id")->update([
                    "sala" => $sala,
                    "predio" => $predio,
                    "id_matricula" => $matricula->id,
                    "membro1banca" => $campos['membro1'],
                    "membro2banca" => $campos['membro2'],
                ]);

                $id_orientador = Auth()->user()->id;
                $log = [ "id_matricula" => $matricula->id,
                    "id_orientador" => $id_orientador,
                    "alteracao" => "Alteração do agendamento.",
                ];
                LogAgendamento::create($log);


                $request->session()->flash('alert-success', 'Alterações Salvas!');
                return redirect()->route('ver_agendamento', ['id' => $id]);
            } else {
                $registro = ["data" => $data,
                    "sala" => $sala,
                    "predio" => $predio,
                    "id_matricula" => $matricula->id,
                    "membro1banca" => $campos['membro1'],
                    "membro2banca" => $campos['membro2'],
                ];
                Agendamento::create($registro);

                $id_orientador = Auth()->user()->id;
                $log = [ "id_matricula" => $matricula->id,
                    "id_orientador" => $id_orientador,
                    "alteracao" => "Realização do agendamento.",
                ];
                LogAgendamento::create($log);

                $request->session()->flash('alert-success', 'Agendamento realizado!');
                return redirect()->route('ver_agendamento', ['id' => $id]);
            }
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

        return view('professor.visualizar_agendamento', compact('id', 'salas', 'semestre', 'professores', 'agendamento', 'logs'));
    }

}
