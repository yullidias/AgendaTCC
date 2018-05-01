<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Cronograma extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'data_inicio', 'data_fim', 'semestre_ano','semestre_numero','turma']; //campos que podem ser inseridos pelo usuário
    protected $guarded = ['id']; //protege os campos de inserção
    protected $table = 'cronogramas'; //nome da tabela
<<<<<<< HEAD
}
=======

}
>>>>>>> ad31a14e2a3edb1e7e9c8c732d0467b15ef1beff
