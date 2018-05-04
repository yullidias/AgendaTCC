<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('login',12)->primary();
            $table->string('senha',45); //mudei de password para senha
            $table->string('nome',45); //mudei de name para nome
            $table->string('email',100)->unique();
            $table->boolean('excluido');
            $table->boolean('ehProfessor');
            $table->binary('orientador');
            $table->binary('professorDisciplina');
            $table->binary('gestor');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
