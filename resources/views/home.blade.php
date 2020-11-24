@extends('layouts/app_layout')

@section('conteudo')
    <div>
        <h3>Conteúdo da aplicação</h3>
        <p>SMS TOKEN: <strong>{{ $smstoken }}</strong></p>
    </div>
@endsection
