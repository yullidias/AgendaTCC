<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCronogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('semestre_ano');
            $table->integer('semestre_numero');
            $table->tinyInteger('turma');
            $table->timestamps();
        });

        Schema::table('cronogramas', function (Blueprint $table) {
            $table->foreign(['semestre_ano','semestre_numero'])->references(['ano','numero'])->on('semestres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cronogramas');
    }
}
