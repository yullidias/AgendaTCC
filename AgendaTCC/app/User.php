<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //  public function getAuthIdentifier()
    //  {
    //    return 'login';
    //  }
    //  public function id()
    //      {
    //          return 'login'; //o padrao é usar o campo de email para autenticação, aqui alteramos para usar o campo login como autenticação
    //      }

    protected $fillable = [
        'login', 'password', 'nome', 'email', 'excluido', 'ehProfessor', 'orientador', 'professorDisciplina', 'gestor'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
