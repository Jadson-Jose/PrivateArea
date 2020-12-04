<?php

namespace App\Http\Controllers;

use App\Classes\Enc;
use App\Classes\Logger;
use App\Classes\Random;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Main extends Controller
{

    private $Enc;
    private $Logger;

    public function __construct()
    {
        $this->Enc = new Enc();
        $this->Logger = new Logger();
    }

    //===================================================
    public function index()
    {
        // Verifica se o usuário está logado.
        if ($this->checkSession()) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login');
        }
    }

    //===================================================
    private function checkSession()
    {
        return session()->has('usuario');
    }

    //===================================================
    public function login()
    {

        // Verifica se já existe sessão
        if ($this->checkSession()) {
            return redirect()->route('index');
        }



        // Apresenta o formulário de login.
        $erro = session('erro');
        $data = [];
        if (!empty($erro)) {
            $data = [
                'erro' => $erro
            ];
        }

        return view('login', $data);
    }

    //===================================================
    public function login_submit(LoginRequest $request)
    {

        // Verifica se houve submissão de formulário
        if (!$request->isMethod('post')) {
            return redirect()->route('index');
        }

        // Verifica se já existe sessão
        if ($this->checkSession()) {
            return redirect()->route('index');
        }


        // Validação
        $request->validated();

        // Verificar dados de login
        $usuario = trim($request->input('text_usuario'));
        $senha = trim($request->input('text_senha'));

        $usuario = Usuario::where('usuario', $usuario)->first();

        // Verifica se existe o usuario
        if (!$usuario) {

            // Logger
            $this->Logger->log('error', trim($request->input('text_usuario')) . ' - Não existe o usuário indicado');

            session()->flash('erro', 'Não existe o usuário');
            return redirect()->route('login');
        }

        // Verificar se a senha está correta
        if (!Hash::check($senha, $usuario->senha)) {

            // Logger
            $this->Logger->log('error', trim($request->input('text_usuario')) . ' - Senha inválida.');

            session()->flash('erro', 'Senha inválida.');
            return redirect()->route('login');
        }



        // Criar sessão ( se login ok )
        session()->put('usuario', $usuario);

        //logger
        $this->Logger->log('info', 'Fez o seu login.');

        return redirect()->route('index');
    }

    //===================================================
    public function logout()
    {
        // Logger
        $this->Logger->log('info', 'Fez o seu logout.');

        session()->forget('usuario');
        return redirect()->route('index');
    }

    //===================================================
    // HOME (entrada da aplicação)
    //===================================================
    public function home()
    {
        if (!$this->checkSession()) {
            return redirect()->route('login');
        }

        $data = [
            'usuarios' => Usuario::all()
        ];

        return view('home', $data);
    }


    //===================================================
    public function edit($id_usuario)
    {
        $id_usuario = $this->Enc->desencriptar($id_usuario);

        echo 'O usuario a editar é: ' . $id_usuario;
    }

    //===================================================
    public function upload(Request $request)
    {

        // Validação do upload
        $validate = $request->validate(
            // Regras
            [
                'arquivo' => 'required|image|mimes:jpg|max:12|dimensions:min_width=10,max_height=10,max_width=1000,max_height=500'
            ],
            // mensagem de erros
            [
                'arquivo.required' => 'A imagem é obrigatória',
                'arquivo.image' => 'O arquivo tem que ser uma imagem',
                'arquivo.mimes' => 'A imgaem tem que ser em formato jpg',
                'arquivo.max' => 'A imagem deve conter no máximo 12 kb',
                'arquivo.dimensions' => 'Tamanho inválido (1000x500 max)'
            ]
        );


        // $request->arquivo->storeAs('public/images', 'novo.jpg');
        echo 'Terminado!';
    }

    //===================================================
    public function lista_arquivos()
    {
        $files = Storage::files('public/pdfs');

        echo '<pre>';
        print_r($files);
    }

    //===================================================
    public function download($file)
    {
        return response()->download("storage/pdfs/$file");
    }
}
