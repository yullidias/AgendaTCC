<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Semestre;
use App\AlunoSemestre;
use App\TccDados;
use App\Avaliacao;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "Se der erro, apague os dados do banco\n";

        /*
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

        User::create([
            'id'=>'adm',
            'password'=>bcrypt('123'),
            'excluido'=>false,
            'professor'=>true,
            'orientador'=>true,
            'professorDisciplina'=>true,
            'gestor'=>true,
        ]);

        User::create([
            'id'=>'321',
            'password'=>bcrypt('123'),
            'professor'=>false,
            'orientador'=>false,
            'professorDisciplina'=>false,
            'gestor'=>false,
        ]);*/

        //professor - gestor - orientador
        User::create([
            'id'=>123,
            'nome'=>'nome1',
            'password'=>bcrypt('123'),
            'email'=>'nome1@email.com',
            'excluido'=>false,
            'professor'=>true,
            'orientador'=>true,
            'professorDisciplina'=>true,
            'gestor'=>true,
        ]);

        //orientador
        User::create([
            'id'=>987,
            'nome'=>'nome2',
            'password'=>bcrypt('987'),
            'email'=>'nome2@email.com',
            'excluido'=>false,
            'professor'=>true,
            'orientador'=>true,
            'professorDisciplina'=>false,
            'gestor'=>false,
        ]);

         //professor
        User::create([
            'id'=>258,
            'nome'=>'nome7',
            'password'=>bcrypt('258'),
            'email'=>'nome7@email.com',
            'excluido'=>false,
            'professor'=>true,
            'orientador'=>false,
            'professorDisciplina'=>true,
            'gestor'=>false,
        ]);

        //gestor - orientador
        User::create([
            'id'=>654,
            'nome'=>'nome3',
            'password'=>bcrypt('654'),
            'email'=>'nome3@email.com',
            'excluido'=>false,
            'professor'=>true,
            'orientador'=>true,
            'professorDisciplina'=>false,
            'gestor'=>true,
        ]);

        //semestres
        Semestre::create([
            'ano' => 2018,
            'numero' => 1,
            'data_inicio' =>'2018-05-01 00:00:00',
            'data_fim' =>'2018-05-01 00:00:00'
        ]);

        Semestre::create([
            'ano' => 2017,
            'numero' => 2,
            'data_inicio' =>'2018-05-01 00:00:00',
            'data_fim' =>'2018-05-01 00:00:00'
        ]);

        //aluno - pre cadastrado
        User::create([
            'id'=>456,
            'nome'=>null,
            'password'=>null,
            'email'=>null,
            'excluido'=>false,
            'professor'=>false,
            'orientador'=>false,
            'professorDisciplina'=>false,
            'gestor'=>false,
        ]);
        AlunoSemestre::create([
            'usuario_aluno' => 456,
            'semestre_ano' => 2018,
            'semestre_numero' => 1,
            'materia' => 1
        ]);

        //aluno - cadastrado
        User::create([
            'id'=>789,
            'nome'=>'nome4',
            'password'=>bcrypt('789'),
            'email'=>'nome4@email.com',
            'excluido'=>false,
            'professor'=>false,
            'orientador'=>false,
            'professorDisciplina'=>false,
            'gestor'=>false,
        ]);

        AlunoSemestre::create([
            'usuario_aluno' => 789,
            'semestre_ano' => 2018,
            'semestre_numero' => 1,
            'materia' => 1
        ]);

        TccDados::create([
            'idDados' => 3,
            'tema' => 'tema_nome4',
            'orientador' => 987,
            'usuario_aluno' => 789,
            'coorientador' => 'nenhum'
        ]);

        //aluno - cadastrado - avaliado
        User::create([
            'id'=>321,
            'nome'=>'nome5',
            'password'=>bcrypt('321'),
            'email'=>'nome5@email.com',
            'excluido'=>false,
            'professor'=>false,
            'orientador'=>false,
            'professorDisciplina'=>false,
            'gestor'=>false,
        ]);
        
        AlunoSemestre::create([
            'usuario_aluno' => 321,
            'semestre_ano' => 2018,
            'semestre_numero' => 1,
            'materia' => 1
        ]);

        TccDados::create([
            'idDados' => 1,
            'tema' => 'tema_nome5',
            'orientador' => 987,
            'usuario_aluno' => 321,
            'coorientador' => 'nenhum'
        ]);

        Avaliacao::create([
            'atitudeCompetencia' => 30,
            'forma' => 30,
            'conteudo' => 40,
            'data' => '2018-05-01 00:00:00',
            'comentario' => 'nenhum',
            'tccDados' => 321,
            'ehOrientador' => 0,
        ]);

        Avaliacao::create([
            'atitudeCompetencia' => 30,
            'forma' => 30,
            'conteudo' => 40,
            'data' => '2018-05-01 00:00:00',
            'comentario' => 'nenhum',
            'tccDados' => 321,
            'ehOrientador' => 1,
        ]);

        //aluno - cadastrado - avaliado
        User::create([
            'id'=>147,
            'nome'=>'nome6',
            'password'=>bcrypt('147'),
            'email'=>'nome6@email.com',
            'excluido'=>false,
            'professor'=>false,
            'orientador'=>false,
            'professorDisciplina'=>false,
            'gestor'=>false,
        ]);
        
        AlunoSemestre::create([
            'usuario_aluno' => 147,
            'semestre_ano' => 2018,
            'semestre_numero' => 1,
            'materia' => 1
        ]);

        TccDados::create([
            'idDados' => 2,
            'tema' => 'tema_nome6',
            'orientador' => 987,
            'usuario_aluno' => 147,
            'coorientador' => 'nenhum'
        ]);

        Avaliacao::create([
            'atitudeCompetencia' => 10,
            'forma' => 10,
            'conteudo' => 10,
            'data' => '2018-05-01 00:00:00',
            'comentario' => 'nenhum',
            'tccDados' => 147,
            'ehOrientador' => 0,
        ]);

        Avaliacao::create([
            'atitudeCompetencia' => 10,
            'forma' => 10,
            'conteudo' => 10,
            'data' => '2018-05-01 00:00:00',
            'comentario' => 'nenhum',
            'tccDados' => 147,
            'ehOrientador' => 1,
        ]);

    }
}
