<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class Main extends Controller
{
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
            session()->flash('erro', 'Não existe o usuário');
            return redirect()->route('login');
        }

        // Verificar se a senha está correta
        if (!Hash::check($senha, $usuario->senha)) {
            session()->flash('erro', 'Senha inválida.');
            return redirect()->route('login');
        }



        // Criar sessão ( se login ok )
        session()->put('usuario', $usuario);
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

        echo 'Ola aplicação';
    }
}
