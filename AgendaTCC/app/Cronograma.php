<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    public $timestamps = false; // False indica que o Eloquent ORM não deve adiministrar as colunas automaticamente

    protected $fillable = ['semestre_ano','semestre_numero','turma']; //campos que podem ser inseridos pelo usuário
    protected $guarded = ['id', 'created_at', 'update_at']; //protege os campos de inserção
    protected $table = 'cronogramas'; //nome da tabela

}
