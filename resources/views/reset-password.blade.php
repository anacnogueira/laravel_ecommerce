@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        <form action="{{ route('password.update') }}" method="post">
             @csrf
             <input type="hidden" name="token" value="{{ $token }}">
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

            <div class="form-group">
                <label for="password_confirmation">Repita a senha:</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="@error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="Resetar senha" />
        </form>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/login.css') }}">
@endpush
