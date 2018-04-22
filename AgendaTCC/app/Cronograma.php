<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronograma extends Model
{
    public function lista(){
        return (object)[
            'descricao' => 'Pre-Projeto',
            'data_inicio' => '12/12/17',
            'data_fim' => '02/03/18'
        ];
    }
}
