<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Object_;

use App\Cronograma;
use App\PassoCronograma;

class CronogramaController extends Controller
{
    public function cadastro(){
        return view('cronograma.cadastro_cronograma');

    }
    public function listar_atividades_cronograma(){
        $registro = PassoCronograma::all();
        return view('cronograma.cadastro_cronograma', compact('registro'));
    }
}
