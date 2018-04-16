<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Semestre extends Model
{
    public $timestamps = false;

    protected $fillable = [
	    'ano','numero'
	];

	private $ano;
	private $numero;

	function __construct($campos){
		$this->ano = $campos['ano'];
	    $this->numero = $campos['numero'];
	}

	public function inserir(){
		DB::table('semestres')->insert([
			'ano' => $this->ano,
			'numero' => $this->numero
		]);
	}

	public function existir(){
		$retorno = DB::table('semestres')->where([
			            ['ano','=', $this->ano ],
			            ['numero','=', $this->numero ]
			        ])->count();
		return (($retorno > 0)? true: false);
	}
}
