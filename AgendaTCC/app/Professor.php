<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'SIAPE','nome','senha','permissao', 'email', 'excluido'
    ];
}
