@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></a></li>
            <li><span>Login</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        <h2>Já sou cliente</h2>
        <form action="{{ route('login.authenticate') }}" method="post">
             @csrf
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="@error('email') is-invalid @enderror">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="@error('password') is-invalid @enderror">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="Entrar" />
        </form>
        <p>
            <a href="{{ route('password.forgot') }}">Esqueci minha senha</a>
        </p>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/login.css') }}">
@endpush
