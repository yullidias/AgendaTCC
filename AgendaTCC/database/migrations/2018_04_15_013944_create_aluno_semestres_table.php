<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoSemestresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_semestres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usuario_aluno',12);
            $table->integer('semestre_ano');
            $table->integer('semestre_numero');
            $table->tinyInteger('materia');
        });

        Schema::table('aluno_semestres', function (Blueprint $table) {
            $table->foreign('usuario_aluno')->references('login')->on('users');
            $table->foreign(['semestre_ano','semestre_numero'])->references(['ano','numero'])->on('semestres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno_semestres');
    }
}
