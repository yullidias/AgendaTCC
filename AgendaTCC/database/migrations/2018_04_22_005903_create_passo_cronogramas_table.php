<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassoCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passo_cronogramas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->integer('semestre_ano');
            $table->integer('semestre_numero');
            $table->tinyInteger('turma');
            $table->timestamps();
        });

        Schema::table('passo_cronogramas', function (Blueprint $table){
            $table->foreign(['semestre_ano','semestre_numero', 'turma'])->references(['semestre_ano','semestre_numero', 'turma'])->on('cronogramas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passo_cronogramas');
    }
}
