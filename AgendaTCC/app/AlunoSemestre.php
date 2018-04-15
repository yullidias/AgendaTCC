<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoSemestre extends Model
{
    public $timestamps = false;

    protected $fillable = [
	    'aluno_matricula','semestre_ano','semestre_numero','materia'
	];
}