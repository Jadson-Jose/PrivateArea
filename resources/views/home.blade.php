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
                    {{ $user->usuario }}
                </li>
            @endforeach
        </ul>
    </div>

    <div>
        <h3>Upload de arquivos</h3>
        <form action="{{ route('main_upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="arquivo">
            <input type="submit" value="Enviar">
        </form>
    </div>
@endsection
