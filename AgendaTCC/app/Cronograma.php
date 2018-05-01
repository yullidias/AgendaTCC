<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Cronograma extends Model
{
    public $timestamps = false;
    protected $fillable = ['nome', 'data_inicio', 'data_fim', 'semestre_ano','semestre_numero','turma']; //campos que podem ser inseridos pelo usuário
    protected $guarded = ['id']; //protege os campos de inserção
    protected $table = 'cronogramas'; //nome da tabela

}



