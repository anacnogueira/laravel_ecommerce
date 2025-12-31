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
        <div class="brands">
            @if(isset($brands))
                @foreach($brands as $brand)
                    <div class="brand-item">
                        <a href="{{ route('brand.show',$brand->permalink) }}">
                            @if (!empty($brand->image))
                                <img src="{{ Storage::url($brand->image) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}">
                            @else
                                <div><h2>{{ $brand->name }}</h2></div>
                            @endif
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="pagination">
            {{ $brands->links() }}
        </div>
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/brands.css') }}">
@endpush
