<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use App\Avaliacao;
use App\TccDados;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Semestre;
use App\AlunoSemestre;
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
            'password' => bcrypt($dados['id']),
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
        }
        return $view;
    }
    //------------------------------------------------------------------------------------
    //Tela gestor tela23 alteracaocadastroaluno
    public function alterar_aluno($dados)
    {
        $semestre=explode('-', $dados['semestre_selecionado']);

        $aluno_semestre = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
        ->where([
            ['users.id', '=',  $dados['id']],
            ['aluno_semestres.semestre_numero', '=', $semestre[0]],
            ['aluno_semestres.semestre_ano', '=', $semestre[1]]
        ])->get()->first();

        if(is_null($aluno_semestre['nome'])){ //so esta pre cadastrado
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
            $coorientador=null;

        }else{ //esta cadastrado

            $aluno_tcc = User::join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
            ->where([
                ['users.id', '=',  $dados['id']]
            ])->get()->first();

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

        $orientadores = User::where('professor','=',true)
        ->whereNotNull('nome')->get();

        
        return view('professor.gestor.alterar_aluno',compact('aluno','orientadores'));
    }

    public function salvar_alterar_aluno(Request $req)
    {
        $dados = $req->all();

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


        if(is_null($aluno_semestre['nome'])){ //so esta pre cadastrado
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
            $orientador=null;
        }else{ //esta cadastrado

            $aluno_tcc = User::join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
            ->where([
                ['users.id', '=',  $dados['id']]
            ])->get()->first();

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

            $orientador = User::where('professor','=',true)
            ->where('id','=',$aluno_tcc['orientador'])->get()->first();

        }

        return view('professor.gestor.visualizar_aluno',compact('aluno','orientador'));
    }

    //------------------------------------------------------------------------------------
    //Tela gestor excluiraluno
     public function excluir_aluno($dados)
    {

         User::where('id','=',$dados['id'])
        ->update([
            'excluido' => true,
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

      //  if(isset($dados['orientador'])){
            User::where('id','=',$dados['id'])
            ->update([
                'orientador' => $dados['orientador']
            ]);
      //  }
      //  if(isset($dados['professorDisciplina'])){
            User::where('id','=',$dados['id'])
            ->update([
                'professorDisciplina' => $dados['professorDisciplina']
            ]);
      //  }
        //if(isset($dados['gestor'])){
            User::where('id','=',$dados['id'])
            ->update([
                'gestor' => $dados['gestor']
            ]);
       // } 

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
            'password' => bcrypt($dados['id']),
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
        $avaliacaos = Avaliacao::where('tccDados','=',$id)->first();
        return view('professor.avaliar_aluno', compact('aluno','avaliacaos'));
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

        Avaliacao::create($avaliacao);
        $request->session()->flash('alert-success', 'Avaliação feita com sucesso!');
        return redirect()->back();
    }

}
