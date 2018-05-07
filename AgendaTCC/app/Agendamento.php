<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Agendamento extends Model
{
    public $timestamps = false;
    protected $fillable = ['data','id_sala','id_matricula','membro1banca','membro2banca'];
    //id_matricula é a id da matricula do aluno (aluno_semestres)//
}

