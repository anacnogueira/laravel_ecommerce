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
        @php
            $msg = urlencode("Olá, estou com dúvidas para navegar no site" );
        @endphp
        <p>Agora você pode fazer suas compras em nosso site.</p>
		<p>Em caso de dúvida, entre em contato no link do <a href="{{ route('pages.contact') }}">Formulário de Contato</a> ou <br>
            por <a href="https://api.whatsapp.com/send?1=pt_BR&phone=5512988681452&text={{ $msg }}">WhatsApp</a>.</p>
		<a href="/" class="button">Voltar para página inicial</a>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/confirm-register.css') }}">
@endpush

