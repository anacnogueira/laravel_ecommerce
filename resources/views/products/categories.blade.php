@extends('layouts.app')

@section('title', $title)

@section('meta')
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="{{ $category->short_description }}"/>
    <meta property="og:title" content="{{ $category->name }}"/>
    <meta property="og:description" content="{{ $category->short_description }}"/>
    <meta property="og:url" content="https://mayacosmeticos.com.br/categorias/{{ $permalink }}"/>
    <link href="https://mayacosmeticos.com.br/categorias/{{ $permalink }}" rel="canonical"/>
@endsection

@section('content')
<nav class="breadcrumb">
    <ul>
        <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
        @foreach ($ancestors as $ancestor)
            <li><a href="/categorias/{{ $ancestor->permalink }}">{{ $ancestor->name }}</a></li>
        @endforeach
        <li><span>{{ $category->name }}</span></li>
    </ul>
</nav>
<div class="container">
    <h1>{{ $category->name }}</h1>
    <div>{!! $category->text !!}</div>
    @include('partials.list-products')
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/categories.css') }}">
@endpush

