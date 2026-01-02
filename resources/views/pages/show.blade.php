@extends('layouts.app')

@php
    $url = "https://mayacosmeticos.com.br/pagina/{$page->permalink}";
@endphp

@section('meta')
    <meta name="robots" content="follow, index"/>
    <meta name="description" content="{{ $page->description }}"/>
    <meta property="og:title" content="{{ $page->title }}"/>
    <meta property="og:description" content="{{ $page->description }}"/>
    <link href="{{ $url }}" rel="canonical"/>
@endsection

@section('title', $page->title)

@section('content')
    <nav class="breadcrumb">
            <ul>
                <li><a href="{{ url('/') }}/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
                <li><span>{{ $page->title }}</span></li>
            </ul>
    </nav>
    <div class="container">
        <h1>{{ $page->title }}</h1>
        {!! $page->content !!}
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/page.css') }}">
@endpush
