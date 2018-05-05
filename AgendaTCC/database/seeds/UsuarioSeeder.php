<?php

use Illuminate\Database\Seeder;
use App\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cria professor com permissão de gestor e professor da Disciplina
        User::create([
            'id'=>'1234567',
            'nome'=>'Alline',
            'password'=>bcrypt('123'),
            'email'=>'allinealuna@email.com',
            'excluido'=>false,
            'professor'=>true,
            'orientador'=>'0',
            'professorDisciplina'=>'1',
            'gestor'=>'1',
        ]);
        //cria aluno
        User::create([
            'id'=>'201522300030',
            'password'=>bcrypt('654321'),
            'professor'=>false,
        ]);
        //cria professor com permissão de orientador
        User::create([
            'id'=>'7654321',
            'password'=>bcrypt('123'),
            'professor'=>true,
            'orientador'=>'1',
            'professorDisciplina'=>'0',
            'gestor'=>'0',
        ]);

        echo "Se der erro, apague os dados do banco\n";

    }
}
