<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlunoSemestre extends Model
{
    public $timestamps = false;

    protected $fillable = [
	    'usuario_aluno','semestre_ano','semestre_numero','materia'
	];

}