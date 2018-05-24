<?php

namespace App\Http\Controllers;
use App\Arquivo;
use Illuminate\Support\Facades\View;

use App\Avaliacao;
use App\TccDados;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Semestre;
use App\AlunoSemestre;
use App\Agendamento;
use Illuminate\Support\Facades\Input;

class ProfessorController extends Controller
{
  //-----------------Gestor-------------------------------------------------------------
  //------------------------------------------------------------------------------------
  //Tela gestor tela22 precadastro aluno
    public function pre_cadastro_aluno(){
        return view('professor.gestor.pre_cadastro_aluno');
    }

    public function salvar_pre_cadastro_aluno(Request $req)
    {
        $this->validate($req, [
            'id' => 'required|unique:users|max:12',
        ],[
                'id.required' => 'Este campo é obrigatorio!',
                'id.unique' => 'Matricula já cadastrada!',
                'id.max' => 'Matricula deve ter no maximo 12 digitos!',
        ]);

        $dados = $req->all();

        $aluno = [
            'id' => $dados['id'],
            'nome' => NULL,
            'password' => NULL,
            'email' => NULL,
            'excluido' => false,
            'professor' => false,
            'orientador' =>  false,
            'professorDisciplina' => false,
            'gestor' => false,
        ];

        $semestre = Semestre::orderBy('ano', 'desc')
                    ->orderBy('numero', 'desc')
                    ->get()->first();

        $alunoSemestre = [
            'usuario_aluno' => $dados['id'],
            'semestre_ano' => $semestre['ano'],
            'semestre_numero' => $semestre['numero'],
            'materia' => intval($dados['materia'])
        ];


        User::create($aluno);
        AlunoSemestre::create($alunoSemestre);

        return redirect()->route('listar_alunos');
    }
    //------------------------------------------------------------------------------------
    //Tela gestor tela21 listadealunos
     public function listar_alunos(Request $req)
    {
        $dados = $req->all();
        $semestres = Semestre::all();

         if(isset($_POST['materia'])){

            $semestre=explode('-', $dados['semestre']);

            $materia_selecionada=$dados['materia'];
            $semestre_selecionado=$dados['semestre'];
            $semestre_ano=$semestre[1];
            $semestre_numero=$semestre[0];

        }else{ //primeira vez

            $semestre = Semestre::orderBy('ano', 'desc')
                    ->orderBy('numero', 'desc')
                    ->get()->first();

            $materia_selecionada=1;
            $semestre_selecionado=$semestre['numero'].'-'.$semestre['ano'];
            $semestre_ano=$semestre['ano'];
            $semestre_numero=$semestre['numero'];
        }

        $alunos = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')->where([
                ['aluno_semestres.materia', '=', $materia_selecionada],
                ['aluno_semestres.semestre_ano', '=', $semestre_ano],
                ['aluno_semestres.semestre_numero', '=', $semestre_numero],
                ['users.professor', '=',  false],
                ['users.excluido', '=',  false],
            ])->get();

        foreach ($alunos as $aluno) {
            $aluno['pode_rematricular'] = false;

            if($aluno['materia']==1){

                $avaliacao_orientador = User::join('avaliacaos', 'users.id', '=', 'avaliacaos.tccDados')
                ->where([
                    ['avaliacaos.ehOrientador', '=', true],
                    ['users.id','=', $aluno['usuario_aluno']]
                ])->get()->first();

                $avaliacao_professor = User::join('avaliacaos', 'users.id', '=', 'avaliacaos.tccDados')
                ->where([
                    ['avaliacaos.ehOrientador', '=', false],
                    ['users.id','=', $aluno['usuario_aluno']]
                ])->get()->first();
                
                if( $avaliacao_orientador!=null && $avaliacao_professor!=null ){  
                    $nota_orientador=$avaliacao_orientador['atitudeCompetencia']+$avaliacao_orientador['forma']+$avaliacao_orientador['conteudo'];
                    $nota_professor=$avaliacao_professor['atitudeCompetencia']+$avaliacao_professor['forma']+$avaliacao_professor['conteudo'];

                    $media=0.6*$nota_orientador+0.4*$nota_professor;

                    if($media >= 60){
                         $aluno['pode_rematricular'] = true;
                     }
                }
            }
        }

        return view('professor.gestor.listar_alunos',compact('alunos','semestres','materia_selecionada','semestre_selecionado'));
    }

    public function operacoes_aluno(Request $req){
        $dados = $req->all();
        switch ($dados['operacao']) {
            case 'Visualizar':
                $view = self::visualizar_aluno($dados);
                break;

            case 'Alterar':
                $view = self::alterar_aluno($dados);
                break;

            case 'Excluir':
                $view = self::excluir_aluno($dados);
                break;

            case 'Rematricular':
                $view = self::rematricular_aluno($dados);
                break;
        }
        return $view;
    }
    //------------------------------------------------------------------------------------
    //Tela gestor tela23 alteracaocadastroaluno
    public function alterar_aluno($dados)
    {
        $semestre=explode('-', $dados['semestre_selecionado']);
        $semestre_selecionado=$dados['semestre_selecionado'];

        $aluno_semestre = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
        ->where([
            ['users.id', '=',  $dados['id']],
            ['aluno_semestres.semestre_numero', '=', $semestre[0]],
            ['aluno_semestres.semestre_ano', '=', $semestre[1]]
        ])->get()->first();

        if(TccDados::where('usuario_aluno', '=', $dados['id'])->count() > 0){ 

             $aluno_tcc = TccDados::where('usuario_aluno', '=', $dados['id'])->get()->first();


            if(Agendamento::join('aluno_semestres', 'agendamentos.id_matricula', '=', 'aluno_semestres.id')
                ->where([
                    ['aluno_semestres.usuario_aluno', '=',  $dados['id']],
                    ['aluno_semestres.semestre_numero', '=', $semestre[0]],
                    ['aluno_semestres.semestre_ano', '=', $semestre[1]]
                ])->count() > 0){


                $aluno_agendamento = Agendamento::join('aluno_semestres', 'agendamentos.id_matricula', '=', 'aluno_semestres.id')
                ->where([
                    ['aluno_semestres.usuario_aluno', '=',  $dados['id']],
                    ['aluno_semestres.semestre_numero', '=', $semestre[0]],
                    ['aluno_semestres.semestre_ano', '=', $semestre[1]]
                ])->get()->first();

                 $aluno = [
                    'id' => $aluno_semestre['usuario_aluno'],
                    'nome'=> $aluno_semestre['nome'],
                    'email'=> $aluno_semestre['email'],
                    'materia'=> $aluno_semestre['materia'],
                    'orientador'=> $aluno_tcc['orientador'],
                    'coorientador'=> $aluno_tcc['coorientador'],
                    'tema'=> $aluno_tcc['tema'],
                    'membro_banca_1' => $aluno_agendamento['membro1banca'],
                    'membro_banca_2' => $aluno_agendamento['membro2banca']
                ];

            }else{

                 $aluno = [
                'id' => $aluno_semestre['usuario_aluno'],
                'nome'=> $aluno_semestre['nome'],
                'email'=> $aluno_semestre['email'],
                'materia'=> $aluno_semestre['materia'],
                'orientador'=> $aluno_tcc['orientador'],
                'coorientador'=> $aluno_tcc['coorientador'],
                'tema'=> $aluno_tcc['tema'],
                'membro_banca_1' => null,
                'membro_banca_2' => null
            ];

            }

        }else{

            $aluno = [
                'id' => $aluno_semestre['usuario_aluno'],
                'nome'=> $aluno_semestre['nome'],
                'email'=> $aluno_semestre['email'],
                'materia'=> $aluno_semestre['materia'],
                'orientador'=> null,
                'coorientador'=> null,
                'tema'=> null,
                'membro_banca_1' => null,
                'membro_banca_2' => null
            ];
        }

        $orientadores = User::where([
            ['professor','=',true],
            ['orientador','=',true]
        ])->whereNotNull('nome')->get();

        
        return view('professor.gestor.alterar_aluno',compact('aluno','orientadores','semestre_selecionado'));
    }

    public function salvar_alterar_aluno(Request $req)
    {
        $dados = $req->all();

        $semestre=explode('-', $dados['semestre_selecionado']);
        $aluno_semestre = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
        ->where([
            ['users.id', '=',  $dados['id']],
            ['aluno_semestres.semestre_numero', '=', $semestre[0]],
            ['aluno_semestres.semestre_ano', '=', $semestre[1]]
        ])->get()->first();

        if(!is_null ($dados['nome'])){
            User::where('id','=',$dados['id'])
            ->update([
                    'nome' => $dados['nome']
            ]);
        }

        if(!is_null ($dados['email'])){
            User::where('id','=',$dados['id'])
            ->update([
                    'email' => $dados['email']
            ]);
        }

        if(!is_null($dados['materia'])){
            AlunoSemestre::where('usuario_aluno','=',$dados['id'])
            ->update([
                'materia' => $dados['materia']
            ]);
        }
         if(!is_null($dados['tema'])){
            TccDados::where('usuario_aluno','=',$dados['id'])
            ->update([
                'tema' => $dados['tema']
            ]);
        }

        if(!is_null($dados['orientador'])){
            TccDados::where('usuario_aluno','=',$dados['id'])
            ->update([
                'orientador' => $dados['orientador']
            ]);
        }

        if(!is_null($dados['coorientador'])){
            TccDados::where('usuario_aluno','=',$dados['id'])
            ->update([
                'coorientador' => $dados['coorientador']
            ]);
        }

        if(!is_null($dados['membro_banca_1'])){
            Agendamento::where('id_matricula', '=', $aluno_semestre['id'])
            ->update([
                'membro1banca' => $dados['membro_banca_1']
            ]);
        }

        if(!is_null($dados['membro_banca_2'])){
            Agendamento::where('id_matricula', '=', $aluno_semestre['id'])
            ->update([
                'membro2banca' => $dados['membro_banca_2']
            ]);
        }



      return redirect()->route('listar_alunos');
    }

    //------------------------------------------------------------------------------------
    //Tela gestor tela24 dadoscadastraisaluno
     public function visualizar_aluno($dados)
    {
        $semestre=explode('-', $dados['semestre_selecionado']);

        $aluno_semestre = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
        ->where([
            ['users.id', '=',  $dados['id']],
            ['aluno_semestres.semestre_numero', '=', $semestre[0]],
            ['aluno_semestres.semestre_ano', '=', $semestre[1]]
        ])->get()->first();

        $aluno_semestre = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
        ->where([
            ['users.id', '=',  $dados['id']],
            ['aluno_semestres.semestre_numero', '=', $semestre[0]],
            ['aluno_semestres.semestre_ano', '=', $semestre[1]]
        ])->get()->first();

        if(TccDados::where('usuario_aluno', '=', $dados['id'])->count() > 0){ 

             $aluno_tcc = TccDados::where('usuario_aluno', '=', $dados['id'])->get()->first();
             $orientador = User::where('professor','=',true)
                ->where('id','=',$aluno_tcc['orientador'])->get()->first();


            if(Agendamento::join('aluno_semestres', 'agendamentos.id_matricula', '=', 'aluno_semestres.id')
                ->where([
                    ['aluno_semestres.usuario_aluno', '=',  $dados['id']],
                    ['aluno_semestres.semestre_numero', '=', $semestre[0]],
                    ['aluno_semestres.semestre_ano', '=', $semestre[1]]
                ])->count() > 0){


                $aluno_agendamento = Agendamento::join('aluno_semestres', 'agendamentos.id_matricula', '=', 'aluno_semestres.id')
                ->where([
                    ['aluno_semestres.usuario_aluno', '=',  $dados['id']],
                    ['aluno_semestres.semestre_numero', '=', $semestre[0]],
                    ['aluno_semestres.semestre_ano', '=', $semestre[1]]
                ])->get()->first();

                 $aluno = [
                    'id' => $aluno_semestre['usuario_aluno'],
                    'nome'=> $aluno_semestre['nome'],
                    'email'=> $aluno_semestre['email'],
                    'materia'=> $aluno_semestre['materia'],
                    'orientador'=> $aluno_tcc['orientador'],
                    'coorientador'=> $aluno_tcc['coorientador'],
                    'tema'=> $aluno_tcc['tema'],
                    'membro_banca_1' => $aluno_agendamento['membro1banca'],
                    'membro_banca_2' => $aluno_agendamento['membro2banca']
                ];

            }else{

                 $aluno = [
                'id' => $aluno_semestre['usuario_aluno'],
                'nome'=> $aluno_semestre['nome'],
                'email'=> $aluno_semestre['email'],
                'materia'=> $aluno_semestre['materia'],
                'orientador'=> $aluno_tcc['orientador'],
                'coorientador'=> $aluno_tcc['coorientador'],
                'tema'=> $aluno_tcc['tema'],
                'membro_banca_1' => null,
                'membro_banca_2' => null
            ];

            }

        }else{

            $aluno = [
                'id' => $aluno_semestre['usuario_aluno'],
                'nome'=> $aluno_semestre['nome'],
                'email'=> $aluno_semestre['email'],
                'materia'=> $aluno_semestre['materia'],
                'orientador'=> null,
                'coorientador'=> null,
                'tema'=> null,
                'membro_banca_1' => null,
                'membro_banca_2' => null
            ];
        }

        return view('professor.gestor.visualizar_aluno',compact('aluno','orientador'));
    }

    //------------------------------------------------------------------------------------
    //Tela gestor excluir aluno
     public function excluir_aluno($dados)
    {

         User::where('id','=',$dados['id'])
        ->update([
            'excluido' => true,
        ]);

         return redirect()->route('listar_alunos');
    }
    //------------------------------------------------------------------------------------
    //Tela gestor rematricular aluno
     public function rematricular_aluno($dados)
    {
        $semestre=explode('-', $dados['semestre_selecionado']);

        AlunoSemestre::where([
            ['usuario_aluno', '=',  $dados['id']],
            ['semestre_numero', '=', $semestre[0]],
            ['semestre_ano', '=', $semestre[1]]
        ])->update([
            'materia' => 2
        ]);

         return redirect()->route('listar_alunos');
    }

    //------------------------------------------------------------------------------------
    //Tela gestor tela19 listaprofessorescadastrados
    public function listar_professores(Request $req)
    {
        $usuarioID=Auth()->user()->id;
        $professores = User::where('excluido',false)->where('professor',true)->where('id','!=',$usuarioID)->get();  
        return view('professor.gestor.listar_professores',compact('professores'));
    }
//------------------------------------------------------------------------------------
 // Tela gestor tela20 dadoscadastraisprofessor
     public function visualizar_professor($id)
    {
        $professor =User::where('id','=',$id)->get()->first();
        return view('professor.gestor.visualizar_professor',compact('professor'));
    }

    //------------------------------------------------------------------------------------
    //Tela gestor Alterar dadosCadastrais Professor
    public function alterar_professor($id)
    {
        $professor = User::where('id', '=',  $id)->get()->first();
        return view('professor.gestor.alterar_professor',compact('professor'));
    }

    public function salvar_alterar_professor(Request $req)
    {
       $dados = $req->all();
        //echo($dados);
        //dd($dados);

       if(isset($dados['permissao_orientador'])){
           $permissao['orientador']= $dados['permissao_orientador'];
       }else{
           $permissao['orientador']= false ;
       }
       if(isset($dados['permissao_professorDisciplina'])){
           $permissao['professorDisciplina']= $dados['permissao_professorDisciplina'];
       }else{
           $permissao['professorDisciplina']= false ;
       }
       if(isset($dados['permissao_gestor'])){
           $permissao['gestor']= $dados['permissao_gestor'];
       }else{
           $permissao['gestor']= false ;
       }
      
       User::where('id','=',$dados['id'])
        ->update([
            'orientador' => $permissao['orientador'],
            'professorDisciplina' => $permissao['professorDisciplina'],
            'gestor' => $permissao['gestor']
        ]);

      return redirect()->route('listar_professores');
    }
//------------------------------------------------------------------------------------
    //Tela gestor  excluir professor
      public function excluir_professor($id)
    {
         User::where('id','=',$id) ->update([
            'excluido' => true,
        ]);
          //verificar se nao esta se excluindo
         return redirect()->route('listar_professores');
    }

    //------------------------------------------------------------------------------------
    //Tela gestor tela29 precadastroprofessor
    public function pre_cadastro_professor(){
        return view('professor.gestor.pre_cadastro_professor');
    }
    public function salvar_pre_cadastro_professor(Request $req)
    {
      
        $dados = $req->all();

         $this->validate($req, [
            'id' => 'required|unique:users',
        ]);

        if(isset($_POST['permissao_orientador'])){
            $dados['permissao_orientador'] = true;
        }else{
            $dados['permissao_orientador']  = false;
        }

        if(isset($_POST['permissao_professorDisciplina'])){
            $dados['permissao_professorDisciplina'] = true;
        }else{
            $dados['permissao_professorDisciplina'] = false;
        }

        if(isset($_POST['permissao_gestor'])){
            $dados['permissao_gestor'] = true;
        }else{
            $dados['permissao_gestor'] = false;
        }

        $professor = [
            'id' => $dados['id'],
            'nome' => NULL,
            'password' => NULL,
            'email' => NULL,
            'excluido' => false,
            'professor' => true,
            'orientador' =>  $dados['permissao_orientador'],
            'professorDisciplina' =>  $dados['permissao_professorDisciplina'],
            'gestor' => $dados['permissao_gestor'],
        ];
        User::create($professor);

        return redirect()->route('listar_professores');
    }
    //-----------------Orientador---------------------------
    //-----------------Professor---------------------------

	public function cadastro_professor(){
        return view('professor.cadastro_professor');
    }
    public function perfil_professor(){
        $professor = User::where([['professor','=',true]])->get();

        return view('professor.perfil_professor', compact('professor'));
    }
    public function solicitar_alteracao(){
        echo "altera dados";
    }

    public function salvar_cadastro_professor(Request $request){
        $dados = $request->all();

        $professor = [
            'id' => $dados['id'],
            'nome' => $dados['nome'],
            'password' => $dados['password'],
            'email' => $dados['email']
        ];


          if(User::where( [['id','=',$professor['id']]])->update([
                'nome' => $professor['nome'],
                'password' => $professor['password'],
                'email' => $professor['email']
            ])){
                $request->session()->flash('alert-success', 'Professor cadastrado com sucesso!');
                return redirect()->route('perfil_professor');
           }else{
                $request->session()->flash('alert-danger', 'Não foi possível cadastrar o professor!');
                return redirect()->back();
	    }

    }

    public function visualizar_lista_alunos(Request $request){
        $dados = $request->all();

        $semestres = Semestre::all();

        if(isset($_POST['materia'])){

            $semestre=explode('-', $dados['semestre']);

            $materia_selecionada=$dados['materia'];
            $semestre_selecionado=$dados['semestre'];
            $semestre_ano=$semestre[1];
            $semestre_numero=$semestre[0];

        }else{ //primeira vez

            $semestre = Semestre::orderBy('ano', 'desc')
                ->orderBy('numero', 'desc')
                ->get()->first();

            $materia_selecionada=1;
            $semestre_selecionado=$semestre['numero'].'-'.$semestre['ano'];
            $semestre_ano=$semestre['ano'];
            $semestre_numero=$semestre['numero'];
        }

        $alunos = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')->where([
            ['aluno_semestres.materia', '=', $materia_selecionada],
            ['aluno_semestres.semestre_ano', '=', $semestre_ano],
            ['aluno_semestres.semestre_numero', '=', $semestre_numero],
            ['users.professor', '=',  false],
            ['users.excluido', '=',  false],
        ])->get();
        return view('professor.visualizar_lista_aluno', compact('alunos','semestres','materia_selecionada','semestre_selecionado'));
    }

    public function professor_visualiza_aluno($id){ //professor


        if(Arquivo::where('TCC','=',$id)->count() > 0){ //tem um arquivo
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
                ->join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
                ->join('arquivos', 'users.id', '=', 'arquivos.TCC')
                ->select('aluno_semestres.usuario_aluno', 'aluno_semestres.materia', 'tcc_dados.tema', 'tcc_dados.orientador', 'tcc_dados.coorientador', 'users.nome', 'users.id', 'users.email', 'arquivos.nomeArquivo')
                ->where('users.id', '=', $id)->get()->first();
        }elseif (TccDados::where('usuario_aluno','=',$id)->count() > 0) { //esta cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
                ->join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
                ->select('aluno_semestres.usuario_aluno', 'aluno_semestres.materia', 'tcc_dados.tema', 'tcc_dados.orientador', 'tcc_dados.coorientador', 'users.nome', 'users.id', 'users.email')
                ->where('users.id', '=', $id)->get()->first();
        }else { //esta so pre cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
                ->select('aluno_semestres.usuario_aluno', 'aluno_semestres.materia')
                ->where('users.id', '=',  $id)->get()->first();
        }
          return view('professor.visualizar_aluno', compact('aluno'));

    }
    public function avaliar_aluno($id){  //professor

        if(TccDados::where('usuario_aluno','=',$id)->count() > 0){ //esta cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
                ->join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
                ->select('aluno_semestres.usuario_aluno', 'aluno_semestres.materia','tcc_dados.tema','tcc_dados.orientador','tcc_dados.coorientador')
                ->where('users.id', '=',  $id)->get()->first();

        }else { //esta so pre cadastrado
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
                ->select('aluno_semestres.usuario_aluno', 'aluno_semestres.materia')
                ->where('users.id', '=',  $id)->get()->first();
        }
        if(Avaliacao::where('tccDados','=',$id)->count() == 2){
            $avaliacaosProf = Avaliacao::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 0]
            ])->first();
            $avaliacaosOrient = Avaliacao::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 1]
            ])->first();

            return view('professor.avaliar_aluno', compact('aluno','avaliacaosOrient','avaliacaosProf'));
        }
        elseif(Avaliacao::where([
            ['tccDados','=',$id],
            ['ehOrientador', '=', 0]
        ])->count() > 0){
            $avaliacaosProf = Avaliacao::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 0]
            ])->first();

            return view('professor.avaliar_aluno', compact('aluno','avaliacaosProf'));
        }
        elseif (Avaliacao::where([
            ['tccDados','=',$id],
            ['ehOrientador', '=', 1]
        ])->count() > 0){
            $avaliacaosOrient = Avaliacao::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 1]
            ])->first();

            return view('professor.avaliar_aluno', compact('aluno','avaliacaosOrient'));
        }
        else{

            return view('professor.avaliar_aluno', compact('aluno'));
        }


    }

    public function salvar_avaliacao(Request $request){ //professor
        $dados = $request->all();
        $mytime = Carbon::now();
        $avaliacao = [
            'atitudeCompetencia' => $dados['atitudeCompetencia2'],
            'forma' => $dados['forma2'],
            'conteudo' => $dados['conteudo2'],
            'data' => $mytime,
            'comentario' => $dados['comentario2'],
            'tccDados' => $dados['usuario_aluno'],
            'ehOrientador' => 0,
        ];
        $avaliacaosProf = Avaliacao::where([
            ['tccDados','=',$dados['usuario_aluno']],
            ['ehOrientador', '=', 0]
        ])->first();

        if(!$avaliacaosProf){
            Avaliacao::create($avaliacao);
        }
        else{
            Avaliacao::where([
                ['tccDados','=',$dados['usuario_aluno']],
                ['ehOrientador', '=', 0]
            ])
                ->update([
                    'atitudeCompetencia' => $dados['atitudeCompetencia2'],
                    'forma' => $dados['forma2'],
                    'conteudo' => $dados['conteudo2'],
                    'data' => $mytime,
                    'comentario' => $dados['comentario2'],
                ]);
        }
        $request->session()->flash('alert-success', 'Avaliação feita com sucesso!');
        return redirect()->back();
    }

}
