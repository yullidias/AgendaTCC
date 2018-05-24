<?php

use Illuminate\Database\Seeder;
use App\Semestre;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Semestre::create([
            'ano'=>2018,
            'numero'=> 1,
            'data_inicio'=> '03/03/2018',
            'data_fim'=>'01/06/2018'
        ]);

        Semestre::create([
            'ano'=>2018,
            'numero'=> 2,
            'data_inicio'=> '03/07/2018',
            'data_fim'=>'01/11/2018'
        ]);

    }
}
