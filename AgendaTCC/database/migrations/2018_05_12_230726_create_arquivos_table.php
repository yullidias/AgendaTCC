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
            $table->string('nomeArquivo',60);
            $table->dateTime('dataSubmissao');
            $table->string('caminho',100);
            $table->string('TCC',12);
            $table->string('comentario',45);
            $table->tinyInteger('versao');
            $table->primary(['dataSubmissao','TCC']);
        });

        Schema::table('arquivos', function (Blueprint $table) {
            $table->foreign('TCC')->references('usuario_aluno')->on('tcc_dados');
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
