<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacaos', function (Blueprint $table) {
            $table->float('atitudeCompetencia');
            $table->float('forma');
            $table->float('conteudo');
            $table->date('data');
            $table->string('comentario',200);
            $table->increments('tccDados');
        });

        Schema::table('avaliacaos', function (Blueprint $table) {
            $table->foreign('tccDados')->references('idDados')->on('tcc_dados');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacaos');
    }
}
