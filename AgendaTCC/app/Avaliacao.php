<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = [
        'atitudeCompetencia', 'forma', 'conteudo', 'data', 'comentario'
    ];
}
