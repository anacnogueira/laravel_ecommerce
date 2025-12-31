@extends('layouts.app')

@section('title', $title)

@section('content')
<nav class="breadcrumb">
    <ul>
        <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
        <li><a href="{{ route('brand.index') }}">Marcas</a></li>
        <li><span>{{ $title }}</span></li>
    </ul>
</nav>
<div class="container">
    <h1>{{ $title }}</h1>
    <div>{!! $description !!}</div>
    @include('partials.list-products')
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection


@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/brand.css') }}">
@endpush
