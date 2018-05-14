<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nomeArquivo','dataSubmissao', 'caminho', 'TCC', 'comentario', 'passoCronograma', 'versao'
    ];
}
