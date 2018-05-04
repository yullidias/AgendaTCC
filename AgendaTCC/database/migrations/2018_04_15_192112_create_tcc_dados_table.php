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
            $table->string('orientador',12);
            $table->string('usuario_aluno',12);
            $table->string('coorientador', 45);
        });


        Schema::table('tcc_dados', function (Blueprint $table) {
            $table->foreign('usuario_aluno')->references('login')->on('users');
            $table->foreign(['orientador'])->references('login')->on('users');
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
