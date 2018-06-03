<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\AlunoSemestre;
use App\Arquivo;
use App\Professor;
use App\Semestre;
use App\TccDados;
use App\User;
use App\Repositories\AlunoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\EmailGestor;

class AlunoController extends Controller
{

    public function cadastro_aluno(){
        $professor = User::where([['professor','=',true]])->get();
        return view('aluno.cadastro_aluno',compact('professor'));
    }
    public function perfil_aluno($id){
        $aluno = User::where([['id','=',$id]])->get();
        $tccDados = TccDados::where([['usuario_aluno','=',$id]])->get();
        $alunoSemestre = AlunoSemestre::where([['usuario_aluno','=',$id]])->get();
        return view('aluno.perfil_aluno', compact('tccDados','aluno','alunoSemestre'));
    }
    public function solicitar_alteracao(Request $request){
        $solicitacao = explode('-', $request['solicitar']);
        $idUsuario = $solicitacao[0];
        $tipoSolicitacao = $solicitacao[1];
        $valorAtual = $solicitacao[2];
        return view('aluno.solicitar_alteracao_aluno', compact('tipoSolicitacao', 'valorAtual'));
    }

    public function salvar_solicitacao_alteracao(Request $request){
//        Mail::to('from@example.com')->send(new EmailGestor());
//        dd($request);
        echo "salvar solicitacao";
    }
    public function salvar_cadastro_aluno(Request $request){
        $dados = $request->all();
        $aluno = [
            'id' => $dados['id'],
            'nome' => $dados['nome'],
            'password' => bcrypt($dados['password']),
            'email' => $dados['email']
        ];
        $orientador = User::where( [['nome','=',$dados['orientador']]])->get()->first();
        $tccDados = [
            'idDados' => NULL,
            'tema' => $dados['tema'],
            'orientador' => $orientador['id'],
            'usuario_aluno' => $dados['id'],
            'coorientador' => $dados['coorientador']
        ];
        $semestre = Semestre::orderBy('ano', 'desc')
            ->orderBy('numero', 'desc')
            ->get()->first();

        $alunoSemestre = [
            'usuario_aluno' => $dados['id'],
            'semestre_ano' => $semestre['ano'],
            'semestre_numero' => $semestre['numero'],
        ];


           if( User::where( [['id','=',$aluno['id']]])->update([
                'nome' => $aluno['nome'],
                'password' => $aluno['password'],
                'email' => $aluno['email']
            ])) {
               TccDados::create($tccDados);
               $request->session()->flash('alert-success', 'Aluno cadastrado com sucesso!');
               return redirect()->route('perfil_aluno');
           }else{
               $request->session()->flash('alert-danger', 'Não foi possível cadastrar o aluno!');
               return redirect()->back();
           }

    }
    public function submeter_tcc(Request $request,$id){
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

        $aluno = User::where([['id','=',$id]])->get();


        return view('aluno.submeter_tcc', compact('aluno','semestres','materia_selecionada','semestre_selecionado'));
    }

    public function salvar_submeter_tcc(Request $request){
        // Define o valor default para a variável que contém o nome da imagem
        $nameFile = null;
        $dados = $request->all();
        $mytime = Carbon::now();
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('file') && $request->file('file')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = "{$request->usuario_aluno}_{$request->tipo}";

            // Recupera a extensão do arquivo
            $extension = $request->file->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->file->storeAs('tcc', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/tcc/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload )
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();

            $request->session()->flash('alert-success', 'Upload do arquivo feito com sucesso!');
            $arquivo = [
                'nomeArquivo' => $dados['tipo'],
                'dataSubmissao' => $mytime,
                'caminho' => "storage/app/public/tcc/".$nameFile,
                'TCC' => $dados['usuario_aluno'],
                'comentario' => $dados['comentario'],
                'versao' => 1,
            ];
            $arquivoBD = Arquivo::where([
                ['TCC','=',$dados['usuario_aluno']],
                ['nomeArquivo', '=', $dados['tipo']]
            ])->first();

            if(!$arquivoBD){
                Arquivo::create($arquivo);
            }
            else{
                Arquivo::where([
                    ['TCC','=',$dados['usuario_aluno']],
                    ['nomeArquivo', '=', $dados['tipo']]
                ])
                    ->update([
                        'versao' =>  2,
                        'comentario' => $dados['comentario'],
                    ]);
            }
            return redirect()->route('perfil_aluno');
        }
        $request->session()->flash('alert-danger', 'Nenhum arquivo selecionado!');
        return redirect()->back();
    }

    public function download( $filename = '' )
    {
        // Check if file exists in app/storage/file folder
        $file_path = storage_path() . "/app/tcc/" . $filename;
        $headers = array(
            'Content-Type: txt',
            'Content-Disposition: attachment; filename='.$filename,
        );
        if ( file_exists( $file_path ) ) {
            // Send Download
            return \Response::download( $file_path, $filename, $headers );
        } else {
            // Error
            exit( 'Arquivo ainda não foi enviado pelo aluno!' );
        }
    }
    public function visualizarNotas(){
        $id="456";//usuario logado;
            $aluno = User::join('aluno_semestres', 'users.id', '=', 'aluno_semestres.usuario_aluno')
                ->join('tcc_dados', 'users.id', '=', 'tcc_dados.usuario_aluno')
                ->select('aluno_semestres.usuario_aluno', 'aluno_semestres.materia', 'tcc_dados.tema', 'tcc_dados.orientador', 'tcc_dados.coorientador', 'users.nome', 'users.id', 'users.email')
                ->where('users.id', '=', $id)->get()->first();

       
            $avaliacaosProf = avaliacaos::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 0]
            ])->get()->first();
        echo($avaliacaosProf);
            $avaliacaosOrient = avaliacaos::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 1]
            ])->get()->first();
            echo($avaliacaosOrient);
        
        
            return view('aluno.visualizarNotas', compact('aluno','avaliacaosOrient','avaliacaosProf'));
        

         
    }
    
    
    
}
