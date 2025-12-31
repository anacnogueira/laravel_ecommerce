@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">
        <h1>{{ $title }}</h1>
        <i class="fas fa-tools"></i>
        <p class="error">Página em manutenção</p>
        <a href="/" class="home">Voltar para página inicial</a>
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/maintenance.css') }}">
@endpush

