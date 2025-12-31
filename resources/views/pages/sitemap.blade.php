@extends('layouts.app')

@section('title', $title)

@section('content')
    <ul class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
        <li role="menuitem"><a href="/"><img src="/img/i-home.png" alt=""></a></li>
        <li class="current">{{  $title }}</li>
    </ul>
    <h1>{{  $title }}</h1>
    <div class="container">
        <div>
            <h2>Categorias</h2>
        </div>
        <div>
            <h2>Páginas</h2>
        </div>
        <div>
            <h2>Minha Conta</h2>
        </div>
    </div>
@endsection
