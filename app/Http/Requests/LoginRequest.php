<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'text_usuario' => ['required', 'email'],
            'text_senha' => ['required', 'min:5', 'max:20']
        ];
    }

    public function messages()
    {
        return [
            'text_usuario.required' => 'O usuario é de preechimento obrigatório.',
            'text_usuario.email' => 'O usuario tem que ser um email válido.',
            'text_senha.required' => 'A senha é obrigatória.',
            'text_senha.min' => 'A senha tem que ter no mínimo :min caracteres.',
            'text_senha.max' => 'A senha tem que ter no máximo :max caracteres.'
        ];
    }
}
