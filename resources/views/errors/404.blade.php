@extends('layouts.app')

@section('title', "Página não encontrada")

@section('content')
    <div class="container">
        <h1>Página não encontrada</h1>
        <p class="error" >
	        A página que você está procurando foi removida ou não existe. Lamentamos pelo ocorrido
        </p>
        <img src="{{ asset("img/cat_404_not_found.jpg") }}" alt='Gato se escondendo' />
      <a href="/" class="home">Voltar para página inicial</a>
    </div>
@endsection


@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/404.css') }}">
@endpush
