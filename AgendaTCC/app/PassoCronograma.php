<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassoCronograma extends Model
{
    public $timestamps = false; // False indica que o Eloquent ORM não deve adiministrar as colunas automaticamente

    protected $fillable = ['nome','data_inicio', 'data_fim', 'semestre_ano', 'semestre_numero', 'turma']; //campos que podem ser inseridos pelo usuário
    protected $guarded = ['id', 'created_at', 'update_at']; //protege os campos de inserção
    protected $table = 'passo_cronogramas'; //nome da tabela

}
