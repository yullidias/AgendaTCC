<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArquivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->string('nome',60);
            $table->dateTime('dataSubmissao');
            $table->string('caminho',100);
            $table->integer('TCC')->unsigned();
            $table->string('comentario',45);
            $table->integer('passoCronograma')->unsigned();
            $table->tinyInteger('versao');
            $table->primary(['dataSubmissao','TCC']);
        });

        Schema::table('arquivos', function (Blueprint $table) {
            $table->foreign('TCC')->references('idDados')->on('tcc_dados');
            $table->foreign(['passoCronograma'])->references('id')->on('cronogramas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arquivos');
    }
}
