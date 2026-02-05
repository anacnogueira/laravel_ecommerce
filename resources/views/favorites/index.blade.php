@extends('layouts.app')

@section('meta')
    <meta name="robots" content="noindex, nofollow"/>

@endsection

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="{{ route('index') }}"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('customer.index') }}">Minha Conta</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        @if ($products->count() > 0)
            @include('partials.list-products')
            <div class="pagination">
                {{ $products->links() }}
            </div>
        @else
           <p>Nenhum produto adicionado aos favoritos</p>
        @endif
    </div>
@endsection


@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/favorites.css') }}">
@endpush
