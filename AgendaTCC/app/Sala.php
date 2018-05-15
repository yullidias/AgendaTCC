<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{

    public $timestamps = false;
    protected $fillable = ['sala', 'predio']; //campos que podem ser inseridos pelo usuário
    protected $table = 'sala_auditorios'; //nome da tabela
}
