@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></a></li>
            <li><span>Contato</span></li>
        </ul>
    </nav>
    <div class="container">

        <h1>{{ $title }}</h1>
        <p>Dúvidas, sugestões, elogios ou simplesmente mandar uma alô? Você só precisa preencher o formulaŕio com seus dados</p>
        <p>Os campos marcados com * são obrigatórios</p>
        <form method="POST" action="/send-contact">
            @csrf
            <div class="form-group">
                <label for="name">Nome:*</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">E-mail:*</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="@error('name') is-invalid @enderror">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="telephone">Telefone:</label>
                <input type="text" name="telephone" id="telephone" class="phone-mask" placeholder="(99)99999-9999">
            </div>
            <div class="form-group">
                <label for="subject">Assunto:*</label>
                <input
                    type="text"
                    name="subject"
                    value="{{ old('subject') }}"
                    id="subject"
                    class="@error('name') is-invalid @enderror">
                @error('subject')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Mensagem:*</label>
                <textarea
                    name="message"
                    id="message"
                    cols="30"
                    rows="6"
                    class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="Enviar" />
        </form>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/contact.css') }}">
@endpush

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
@endpush
