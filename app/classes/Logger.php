<?php

namespace App\Classes;

use Illuminate\Support\Facades\Log;

class Logger
{
    public function log($level, $message)
    {
        // Tenta adicionar a mensagem a indentificação do usuário ativo
        if (session()->has('usuario')) {
            $message = '[' . session('usuario')->usuario . '] - ' . $message;
        } else {
            $message = '[N/A] - ' . $message;
        }

        // Registra uma mensagem nos logs
        Log::channel('main')->$level($message);
    }
}
