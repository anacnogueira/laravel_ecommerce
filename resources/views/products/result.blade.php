
@extends('layouts.app')

@section('meta')
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="{{ $title }}"/>
    <meta property="og:site_name" content="Maya Cosméticos"/>
    <meta property="og:title" content="{{ $title }}""/>
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="{{ $title }}""/>
    <meta property="og:image" content="https://mayacosmeticos.com.br/img/logo.jpg"/>
    <meta property="og:url" content="https://mayacosmeticos.com.br/"/>
    <link href="https://mayacosmeticos.com.br/resultado-busca/{{ $keyword }}" rel="canonical"/>
    <meta name="google-adsense-account" content="ca-pub-6851308508710738">
@endsection

@section('title', $title)

@section('content')
    <div class="container">
         <nav class="breadcrumb">
            <ul>
                <li><a href="/"><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></a></li>
                <li><span>Resultado da Busca</span></li>
                <li><span id="result-keyword">{{ $keyword }}</span></li>
            </ul>
        </nav>
        <h1>{{ $title }}</h1>
        @if ($products->count() > 0)
            @include('partials.list-products')
            <div class="pagination">
                {{ $products->links() }}
            </div>
        @else
            <p class="panel alert">Nenhum produto encontrado para sua busca</p>
        @endif
        <p>Não encontrou o que estava procurando? Mande-nos uma mensagem por WhatsApp<br>
         <button type="button" class="btn-whatsapp">
            <i class="fa-brands fa-whatsapp"></i>
            Conversar por WhatsApp
        </button></p>

    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/result.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset("js/utils/search-by-whatsapp-button.js") }}"></script>
@endpush
