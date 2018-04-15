<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    public $timestamps = false;

    protected $fillable = [
	    'matricula','nome','senha','email'
	];
}
