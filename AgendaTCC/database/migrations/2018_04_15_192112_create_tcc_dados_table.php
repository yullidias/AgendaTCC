<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTccDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tcc_dados', function (Blueprint $table) {
            $table->increments('idDados');
            $table->string('tema', 45);
            $table->integer('orientador');
            $table->integer('aluno_matricula');
            $table->string('coorientador', 45);
        });


        Schema::table('tcc_dados', function (Blueprint $table) {
            $table->foreign('aluno_matricula')->references('matricula')->on('alunos');
            $table->foreign(['orientador'])->references('SIAPE')->on('professors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tcc_dados');
    }
}
