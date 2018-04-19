<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Aluno extends Model
{
    public $timestamps = false;

    protected $fillable = [
	    'matricula','nome','senha','email'
	];

	private $matricula;
    private $nome;
    private $senha;
    private $email;

	function __construct($campos){
		$this->matricula = $campos['matricula'];
	    $this->nome = $campos['nome'];
	    $this->senha = $campos['senha'];
	    $this->email = $campos['email'];
	}

	public function inserir(){
		DB::table('alunos')->insert([
			'matricula' => $this->matricula,
			'nome' => $this->nome,
            'senha' => $this->senha,
            'email' => $this->email
		]);
	}

	public function alterar(){
		DB::table('alunos')
	        ->where('matricula','=', $this->matricula)
	        ->update([
	            'nome' => $this->nome,
	            'senha' => $this->senha,
	            'email' => $this->email
	        ]);
		}

	public function existir(){
		$retorno = DB::table('alunos')->where('matricula','=',$this->matricula)->count();
		return (($retorno > 0)? true: false);
	}

}
