@extends('layouts.app')

@section('title', $title)

@section('content')
    <ul class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
        <li role="menuitem"><a href="/"><img src="/img/i-home.png" alt=""></a></li>
        <li class="current">Contato</li>
    </ul>
    <h1>Contato</h1>
    <form method="POST" action="/send-contact">
        @csrf
        <div class="form-group">
            <label for="name">Nome:*</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:*</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="telephone">Telefone:</label>
            <input type="text" name="telephone" id="telephone">
        </div>
        <div class="form-group">
            <label for="subject">Telefone:</label>
            <input type="text" name="subject" id="subject">
        </div>
        <div class="form-group">
            <label for="message">Mensagem:</label>
            <textarea name="message" id="message" cols="30" rows="6"></textarea>
        </div>
        <div class="submit">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
@endsection
