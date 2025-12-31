
@extends('layouts.app')

@section('meta')
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="{{ $title }}"/>
    <meta property="og:title" content="{{ $title }}""/>
    <meta property="og:description" content="Veja o que acabou de chegar na loja"/>
    <meta property="og:image" content="https://mayacosmeticos.com.br/img/logo.jpg"/>
    <link href="https://mayacosmeticos.com.br/novidades" rel="canonical"/>
@endsection

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></a></li>
            <li><span>Novidades</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        @include('partials.list-products')
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/news.css') }}">
@endpush
