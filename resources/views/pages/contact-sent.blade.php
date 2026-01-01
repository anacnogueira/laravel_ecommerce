@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        <p>Seu formulário foi enviado, em breve entraremos em contato.</p>
		<p><strong>Maya Cosméticos</strong></p>
		<a href="/" class="home">Voltar para página inicial</a>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/contact-sent.css') }}">
@endpush


