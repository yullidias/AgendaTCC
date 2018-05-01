<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlunoSemestre extends Model
{
    public $timestamps = false;

    protected $fillable = [
	    'aluno_matricula','semestre_ano','semestre_numero','materia'
	];

	/*private $aluno_matricula;
	private $semestre_ano;
	private $semestre_numero;
	private $materia;

	function __construct($campos){
		$this->aluno_matricula = $campos['aluno_matricula'];
		$this->semestre_ano = $campos['semestre_ano'];
		$this->semestre_numero = $campos['semestre_numero'];
		$this->materia = $campos['materia'];
	}

	public function inserir(){
		DB::table('aluno_semestres')->insert([
			'aluno_matricula' => $this->aluno_matricula,
			'semestre_ano' => $this->semestre_ano,
			'semestre_numero' => $this->semestre_numero,
			'materia' => $this->materia
		]);
	}*/
}