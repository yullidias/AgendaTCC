<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AlunosTableSeeder::class);
        $this->call(ProfessorsTableSeeder::class);
    }
}
