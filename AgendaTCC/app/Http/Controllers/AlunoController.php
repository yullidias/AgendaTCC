<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\AlunoSemestre;
use App\Arquivo;
use App\Professor;
use App\Semestre;
use App\TccDados;
use App\User;
use App\Agendamento;
use App\Repositories\AlunoRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\EmailGestor;
use Mail;

class AlunoController extends Controller
{
    public function cadastro_aluno(){
        $professor = User::where([['professor','=',true]])->get();
        return view('aluno.cadastro_aluno',compact('professor'));
    }
    public function perfil_aluno(){
        $usuarioLogado = auth()->user();
        $id = $usuarioLogado['id'];
        $aluno = User::where([['id','=',$id]])->get();
        $tccDados = TccDados::where([['usuario_aluno','=',$id]])->get();
        $alunoSemestre = AlunoSemestre::where([['usuario_aluno','=',$id]])->get();
        $agendamento = Agendamento::where([['id_matricula', '=', $alunoSemestre[0]['id']]])->orderby('data', 'desc')->get();
        return view('aluno.perfil_aluno', compact('tccDados','aluno','alunoSemestre', 'agendamento'));
    }
    public function solicitar_alteracao(Request $request){
        $solicitacao = explode('-', $request['solicitar']);
        $tipoSolicitacao = $solicitacao[0];
        $valorAtual = $solicitacao[1];
        return view('aluno.solicitar_alteracao_aluno', compact('tipoSolicitacao', 'valorAtual'));
    }

    public function salvar_solicitacao_alteracao(Request $request){
        $tipoSolicitacao = $request['solicitacao'];
        $valorAtual = $request['atual'];
        $valorAlterado = $request['novo'];
        $justificativa = $request['justificativa'];
        $matricula = auth()->user()['id'];
        Mail::send([], [], function ($message) use ($justificativa, $valorAlterado, $valorAtual, $tipoSolicitacao, $matricula) {
            $message->to('from@example.com')
                ->subject('Alteracao '. $tipoSolicitacao .' - ' . auth()->user()['nome'])
                ->replyTo(auth()->user()['email'], auth()->user()['nome'])
                ->setBody("<div class='form-group' >
                            <label><p>Matrícula Aluno</p></label>
                            <input class='form-control' style= 'height: 50px; width: 700px' value=$matricula readonly></input><br>
                            <label><p>$tipoSolicitacao Atual</p></label>
                            <textarea class='form-control' style= 'height: 50px; width: 700px' readonly>$valorAtual</textarea><br>
                            <label><p>$tipoSolicitacao Novo</p></label>
                            <textarea class='form-control' style= 'height: 50px; width: 700px' readonly>$valorAlterado</textarea>
                            <label><p>Justificativa</p></label>
                            <textarea class='form-control' style= 'height: 200px; width: 900px' readonly>$justificativa</textarea>
                           </div>"
                    ,'text/html');
        });
        return redirect()->route('perfil_aluno');
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
        $id="321";//usuario logado;
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

            return view('aluno.visualizarNotas', compact('aluno','avaliacaosOrient','avaliacaosProf'));
        }
        elseif(Avaliacao::where([
            ['tccDados','=',$id],
            ['ehOrientador', '=', 0]
        ])->count() > 0){
            $avaliacaosProf = Avaliacao::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 0]
            ])->first();

            return view('aluno.visualizarNotas', compact('aluno','avaliacaosProf'));
        }
        elseif (Avaliacao::where([
            ['tccDados','=',$id],
            ['ehOrientador', '=', 1]
        ])->count() > 0){
            $avaliacaosOrient = Avaliacao::where([
                ['tccDados','=',$id],
                ['ehOrientador', '=', 1]
            ])->first();

            return view('aluno.visualizarNotas', compact('aluno','avaliacaosOrient'));
        }
        else{

            return view('aluno.visualizarNotas', compact('aluno'));
        }

         
    }
    
    
    
}
