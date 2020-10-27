<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function login_submit(Request $request)
    {
        echo 'Submetido';
    }
}
