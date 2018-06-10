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
        else { //verifica se a sala está disponivel
            $array = explode('-', $campos['sala']);
            $sala = substr($array[1], 6, strlen($array[1]) - 6);
            $predio = substr($array[0], 8, strlen($array[0]) - 9);

            $matricula = AlunoSemestre::where([['usuario_aluno', '=', $id],
                                                ['semestre_ano', '=', $semestre->ano],
                                                ['semestre_numero', '=', $semestre->numero],
                                                ['materia', '=', "2"],])->get()->first();

            $agendamentos = Agendamento::where([ ['sala', '=', $sala ], //verifica os agendamentos na mesma sala//
                                                 ['predio', '=', $predio ], ])->get();

            foreach($agendamentos as $agendamento){ //verifica os agendamentos na mesma sala//
                $array = explode(' ', $agendamento->data);
                $data_agendamento = $array[0];
                $horario_agendamento = $array[1];
                if( $agendamento->id_matricula != $matricula->id && //se não é o meu agendamento
                    $campos['data'] == $data_agendamento && //é no mesmo dia
                    $horario_agendamento<=($campos['horario']+2) &&  //e num horario proximo//
                    $horario_agendamento>=($campos['horario']-2) ){
                        $request->session()->flash('alert-danger', 'Já existe um agendamento nessa sala na mesma data, no horário de '.$horario_agendamento.".");
                        return redirect()->route('ver_agendamento', ['id' => $id]);
                }
            }
            $meu_agendamento = Agendamento::where('id_matricula', '=', $matricula->id)->get()->first();

            $data = $campos['data'] . " " . $campos['horario'];
            $dados = $data . " - Predio " . $predio . " - Sala " . $sala;

            if ($meu_agendamento) { //verifica se existe o agendamento e atualiza//
                Agendamento::where("id_matricula", '=', "$matricula->id")->update([
                            "data" => $data,
                            "sala" => $sala,
                            "predio" => $predio,
                            "id_matricula" => $matricula->id,
                            "membro1banca" => $campos['membro1'],
                            "membro2banca" => $campos['membro2'],
                ]);

                $id_orientador = Auth()->user()->id;
                $log = ["id_matricula" => $matricula->id,
                        "id_orientador" => $id_orientador,
                        "alteracao" => "Alteração do agendamento [" . $dados . "]",
                ];
                LogAgendamento::create($log);
                $request->session()->flash('alert-success', 'Alterações Salvas!');
                return redirect()->route('ver_agendamento', ['id' => $id]);
            } else { //se não existe, cria//
                $registro = ["data" => $data,
                            "sala" => $sala,
                            "predio" => $predio,
                            "id_matricula" => $matricula->id,
                            "membro1banca" => $campos['membro1'],
                            "membro2banca" => $campos['membro2'],
                ];
                Agendamento::create($registro);

                $id_orientador = Auth()->user()->id;
                $log = ["id_matricula" => $matricula->id,
                    "id_orientador" => $id_orientador,
                    "alteracao" => "Realização do agendamento [" . $dados . "]",
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
