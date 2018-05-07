<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendamentosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->dateTime('data');
            $table->integer('id_sala')->unsigned();
            $table->integer('id_matricula')->unsigned();
            $table->string('membro1banca');
            $table->string('membro2banca');
            $table->primary(['data', 'id_sala', 'id_matricula']);
        });

        Schema::table('agendamentos', function (Blueprint $table) {
            $table->foreign('id_sala')->references('id')->on('sala_auditorios');
            $table->foreign('id_matricula')->references('id')->on('aluno_semestres');
        });
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
