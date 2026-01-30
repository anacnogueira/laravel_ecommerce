@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="{{ route('index') }}"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('customer.index') }}">Minha Conta</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">

        <h1>{{ $title }}</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <p>Os campos marcados com * são obrigatórios</p>
        <form method="POST" action="{{ route('customers.update-password') }}">
            @method('PUT')
            @csrf
           <div class="form-group">
                <label for="old-password">Senha Atual:*</label>
                <input
                    type="password"
                    name="old_password"
                    id="old-password"
                    class="@error('old_password') is-invalid @enderror">
                @error('old_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="old-password">Nova Senha:*</label>
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
                <label for="password-confirmation">Redigite a nova senha:*</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password-confirmation"
                    class="@error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="Enviar" />
        </form>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/customer-edit-password.css') }}">
@endpush
