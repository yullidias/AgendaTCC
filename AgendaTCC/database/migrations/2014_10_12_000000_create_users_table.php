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
            $table->string('id',12)->primary();
            $table->string('password',250); //mudei de password para senha
            $table->string('nome',45)->nullable(); //mudei de name para nome
            $table->string('email',100)->nullable()->unique();
            $table->boolean('excluido')->nullable();
            $table->boolean('professor');
            $table->boolean('orientador')->nullable();
            $table->boolean('professorDisciplina')->nullable();
            $table->boolean('gestor')->nullable();
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
