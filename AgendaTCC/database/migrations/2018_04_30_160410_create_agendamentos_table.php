<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('agendamentos', function (Blueprint $table) {
            $table->dateTime('data');
            $table->integer('id_sala');
            $table->bigInteger('aluno_matricula');
            $table->string('membro1');
            $table->string('membro2');
            $table->primary(['data', 'id_sala', 'aluno_matricula']);
        });

        Schema::table('agendamentos', function (Blueprint $table) {
            $table->foreign('id_sala')->references('id')->on('sala_auditorios');
            $table->foreign('aluno_matricula')->references('matricula')->on('alunos');
        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamentos');
    }
}
