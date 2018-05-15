<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAgendamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_agendamentos', function (Blueprint $table) {
            $table->integer('id')->increment();
            $table->integer('id_matricula')->unsigned();
            $table->string('id_orientador',12);
            $table->string('alteracao',75);
            $table->timestamps();
        });

        Schema::table('log_agendamentos', function (Blueprint $table) {
            $table->foreign('id_matricula')->references('id')->on('aluno_semestres');
            $table->foreign(['id_orientador'])->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_agendamentos');
    }
}
