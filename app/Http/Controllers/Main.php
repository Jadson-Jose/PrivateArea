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
        if (session()->has('usuario')) {
            echo 'Logado';
        } else {
            return redirect()->route('login');
        }
    }

    //===================================================
    public function login()
    {
        // Apresenta o formulário de login.
        return view('login');
    }

    //===================================================
    public function login_submit(LoginRequest $request)
    {
        // Validação
        $request->validated();

        // Verificar dados de login
        $usuario = trim($request->input('text_usuario'));
        $senha = trim($request->input('text_senha'));

        $usuario = Usuario::where('usuario', $usuario)->first();

        // Verifica se existe o usuario
        if (!$usuario) {
            echo 'ERRO';
            return;
        }

        // Verificar se a senha está correta
        if (!Hash::check($senha, $usuario->senha)) {
            echo 'OK';
            return;
        }



        // Criar sessão ( se login ok )
        echo 'SESSÃO';
    }

    //===================================================

}
