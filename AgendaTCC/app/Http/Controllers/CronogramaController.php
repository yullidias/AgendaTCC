<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

class CronogramaController extends Controller
{
    public function cadastro(Request $var){
        $atividades = [
            (object)["descricao" => "Pre-Projeto", "data_inicio" => "12/12/17", "data_fim" => "02/03/18"],
            (object)["descricao" => "Projeto", "data_inicio" => "12/02/17", "data_fim" => "12/04/18"],
            (object)["descricao" => "Passo X", "data_inicio" => "01/01/18", "data_fim" => "03/03/18"],
        ];
        return view('cronograma.cadastro_cronograma', compact('atividades'));
    }
}
