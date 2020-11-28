@extends('layouts/app_layout')


@php
$enc = new App\Classes\Enc();
@endphp


@section('conteudo')
    <div>
        <h3>LISTA DE USUÁRIOS</h3>
        <hr>

        <ul>
            @foreach ($usuarios as $user)

                <li> <a href="{{ route('main_edit', ['id_usuario' => $enc->encriptar($user->id)]) }}">EDIT</a>
                    {{ $user->usuario }}</li>
            @endforeach
        </ul>

    </div>
@endsection
