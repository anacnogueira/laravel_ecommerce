@extends('layouts.app')

@php
    $url = "https://mayacosmeticos.com.br/faq";
@endphp

@section('meta')
    <meta name="robots" content="follow, index"/>
    <meta name="description" content="Perguntas e Respostas mais frequentes"/>
    <meta property="og:title" content="{{ $title }}"/>
    <meta property="og:description" content="Perguntas e Respostas mais frequentes"/>
    <link href="{{ $url }}" rel="canonical"/>
@endsection

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="{{ url('/') }}/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        <div class="faq-container">
            @foreach ($faqs as $faq)
                <div class='faq-item'>
                    <button class="faq-question">
                        <h2>
                            <i class='fa fa-chevron-down arrow'></i>
                            {{ strip_tags($faq->question) }}
                        </h2>
                    </button>
                    <div class='faq-answer'>
                        {!! $faq->answer !!}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $faqs->links() }}
        </div>
        <p>
            Não encontrou o que estava procurando?
            <a href="{{ url('contato') }}">Envie sua pergunta</a>
        </p>
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/faq.css') }}">
@endpush


@push("scripts")
    <script type="text/javascript" src="{{ asset('js/faq-accordeon.js') }}"></script>
@endpush
