
@extends('layouts.app')

@section('meta')
    <meta name="robots" content="index, follow"/>
    <meta name="description" content="Loja online de venda de maquiagem, base e necessaires com os melhores preços do Brasil. Pagamento por boleto, cartão de crédito ou pix"/>
    <meta property="og:site_name" content="Maya Cosméticos"/>
    <meta property="og:title" content="Maya Cosméticos Loja Virtual de Cosméticos"/>
    <meta property="og:type" content="website"/>
    <meta property="og:description" content="Loja virtual de maquiagem, aqui você encontra o que precisa sobre maquiagem, pincéis, bases e muito mais"/>
    <meta property="og:image" content="https://mayacosmeticos.com.br/img/logo.jpg"/>
    <meta property="og:url" content="https://mayacosmeticos.com.br/"/>
    <link href="https://mayacosmeticos.com.br/" rel="canonical"/>
    <meta name="google-adsense-account" content="ca-pub-6851308508710738">
@endsection

@section('title', $title)

@section('content')
    @include('partials.banners-show')
    @include('partials.commodity')
    <div class="container">
        <h1>Aqui você encontra maquiagem, cuidados com a pele, cabelo e muito mais</h1>
        @include('partials.list-products')
    </div>
@endsection


@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/index.css') }}">
@endpush
