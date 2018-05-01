<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Semestre extends Model
{
    public $timestamps = false;
    protected $fillable = [
<<<<<<< HEAD
        'ano','numero'
    ];
   /* private $ano;
    private $numero;
    function _construct($campos){
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
    }*/
}
=======
	    'ano','numero'
	];

	private $ano;
	private $numero;

    function _construct($campos){
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
>>>>>>> ad31a14e2a3edb1e7e9c8c732d0467b15ef1beff
