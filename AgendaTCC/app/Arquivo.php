<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nome','dataSubmissao', 'caminho', 'TCC', 'comentario', 'passoCronograma', 'versao'
    ];
}
