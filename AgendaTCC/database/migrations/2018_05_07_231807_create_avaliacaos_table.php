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
            $table->increments('idAvaliacao');
            $table->float('atitudeCompetencia');
            $table->float('forma');
            $table->float('conteudo');
            $table->date('data');
            $table->string('comentario',200);
            $table->string('tccDados',12);
            $table->boolean('ehOrientador');
        });

        Schema::table('avaliacaos', function (Blueprint $table) {
            $table->foreign('tccDados')->references('id')->on('users');

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
