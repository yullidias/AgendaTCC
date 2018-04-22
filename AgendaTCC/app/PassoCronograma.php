<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassoCronograma extends Model
{
    public function lista(){
        return (object)[
            'descricao' => 'Passo',
            'data_inicio' => '12/12/12',
            'data_fim' => '25/12/13'
        ];
    }
}
