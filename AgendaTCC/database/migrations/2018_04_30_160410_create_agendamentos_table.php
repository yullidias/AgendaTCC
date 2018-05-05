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
            $table->string('usuario_aluno',12);
            $table->string('membro1banca');
            $table->string('membro2banca');
            $table->primary(['data', 'id_sala', 'usuario_aluno']);
        });

        Schema::table('agendamentos', function (Blueprint $table) {
            $table->foreign('id_sala')->references('id')->on('sala_auditorios');
            $table->foreign('usuario_aluno')->references('id')->on('users');
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
