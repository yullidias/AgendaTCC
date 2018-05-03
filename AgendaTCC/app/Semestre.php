<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Semestre extends Model
{
    public $timestamps = false;
    protected $fillable = [ 'ano','numero', 'data_inicio', 'data_fim' ];

}

