<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'idAvaliacao','atitudeCompetencia', 'forma', 'conteudo', 'data', 'comentario', 'tccDados','ehOrientador'
    ];
}
