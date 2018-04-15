<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    public $timestamps = false;

    protected $fillable = [
	    'ano','numero'
	];
}
