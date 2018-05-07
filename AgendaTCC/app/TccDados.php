<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TccDados extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'idDados','tema','orientador','usuario_aluno','coorientador'
    ];

   /* private $idDados;
    private $tema;
    private $orientador;
    private $aluno_matricula;
    private $coorientador;

    function __construct($campos){
        $this->idDados = $campos['idDados'];
        $this->tema = $campos['tema'];
        $this->orientador = $campos['orientador'];
        $this->aluno_matricula = $campos['aluno_matricula'];
        $this->coorientador = $campos['coorientador'];
    }

    public function inserir(){
        DB::table('tcc_dados')->insert([
            'idDados' => $this->idDados,
            'tema' => $this->tema,
            'orientador' => $this->orientador,
            'aluno_matricula' => $this->aluno_matricula,
            'coorientador' => $this->coorientador
        ]);
    }

    public function alterar(){
        DB::table('tcc_dados')
            ->where('idDados','=', $this->idDados)
            ->update([
                'tema' => $this->tema,
                'orientador' => $this->orientador,
                'aluno_matricula' => $this->aluno_matricula,
                'coorientador' => $this->coorientador
            ]);
    }

    public function existir(){
        $retorno = DB::table('tcc_dados')->where('idDados','=',$this->idDados)->count();
        return (($retorno > 0)? true: false);
    }*/

}
