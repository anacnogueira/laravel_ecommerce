@extends('layouts.app')

@section('title', $title)

@section('content')
     <nav class="breadcrumb">
        <ul>
            <li><a href="{{ url('/') }}"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><span>{{  $title }}</span></li>
        </ul>
    </nav>

    <div class="container">
        <h1>{{  $title }}</h1>
        <div>
            <h2>Categorias</h2>
            <div class="tree_top">
                <a href="{{ url('/') }}"><img src="{{ asset('img/i-home.png') }}" alt='Página Inicial' /></a>
                <ul class="left tree">
                    @foreach ($categories as $category)
                        <li>
                            <a href="/categorias/{{ $category->permalink}}">{{ $category->name }}</a>
                            @if(count($category->children) > 0)
                                <ul>
                                    @foreach ($category->children as $children)
                                        <li>
                                            <a href="/categorias/{{ $children->permalink}}">{{  $children->name }}</a>
                                            @if(count($children->children) > 0)
                                                <ul>
                                                    @foreach ($children->children as $subcategory)
                                                        <li>
                                                            <a href="/categorias/{{ $subcategory->permalink }}">{{ $subcategory->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    <li><a href="{{ url('novidades') }}" title="Novidades"> Novidades</a></li>
                    <li>
                        <a href="{{ url('marcas') }}" title="Marcas">Marcas</a>
                        <ul>
                            @foreach ($brands as $brand)
                                @php
                                    $slugName = Str::slug($brand->name,'-');
                                    $link = !empty($brand->permalink) ?
                                    $brand->permalink :
                                    "/" . $brand->id."/".$slugName;
                                @endphp
                                <li>
                                    <a href="/marca/{{ $link }}">{{ $brand->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        <div>
            <h2>Páginas</h2>
            <ul class="left tree">
                @foreach ($pages as $page)
                    <li>
                        <a href="/pagina/{{ $page->permalink }}">{{ $page->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection


@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/sitemap.css') }}">
@endpush
