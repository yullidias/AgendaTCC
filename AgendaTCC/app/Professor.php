<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Professor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'SIAPE','nome','senha','permissao', 'email', 'excluido'
    ];

    private $SIAPE;
    private $nome;
    private $senha;
    private $permissao;
    private $email;
    private $excluido;

	function __construct($campos){
		$this->SIAPE = $campos['SIAPE'];
	    $this->nome = $campos['nome'];
	    $this->senha = $campos['senha'];
	    $this->permissao = $campos['permissao'];
	    $this->email = $campos['email'];
	    $this->excluido = $campos['excluido'];
	}

	public function inserir(){
		DB::table('professors')->insert([
			'SIAPE' => $this->SIAPE,
			'nome' => $this->nome,
            'senha' => $this->senha,
            'permissao' => $this->permissao,
            'email' => $this->email,
            'excluido' => $this->excluido
		]);
	}

	public function alterar(){
		DB::table('professors')
	        ->where('SIAPE','=', $this->SIAPE)
	        ->update([
	            'nome' => $this->nome,
	            'senha' => $this->senha,
	            'permissao' => $this->permissao,
	            'email' => $this->email,
	            'excluido' => $this->excluido
	        ]);
		}

	public function existir(){
		$retorno = table('professors')->where('SIAPE','=',$this->SIAPE)->count();
		return (($retorno > 0)? true: false);
	}
}
