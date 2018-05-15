<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LogAgendamento extends Model
{

    public $timestamps = true;
    protected $fillable = ['id_matricula','id_orientador','alteracao'];
}
