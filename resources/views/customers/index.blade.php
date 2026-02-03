@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="{{ route('index') }}"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="customer-modules">
            <div class="my-orders">
                <h2>Meus Pedidos</h2>
                <p>Acompanhe o andamento e o histórico dos seus pedidos</p>
		        <ul>
		            <li><a href="{{ url('/meus-pedidos/filtro:ultimos') }}" class="button">Últimos pedidos</a></li>
			        <li><a href="{{ url('/meus-pedidos/filtro:abertos') }}" class="button"> Pedidos Abertos</a></li>
			        <li><a href="{{ url('/meus-pedidos/filtro:entregues') }}" class="button">Pedidos Entregues</a></li>
			        <li><a href="{{ url('/meus-pedidos/filtro:numero') }}" class="button">Pedidos por número</a></li>
			        <li><a href="{{ url('/meus-pedidos/filtro:data') }}" class="button">Pedidos por data</a></li>
				</ul>
            </div>
            <div class="my-data">
                <h2>Meus Dados Cadastrais</h2>
                <p>Mantenha os seus dados cadastrais atualizados</p>
		        <ul>
		            <li><a href="{{ url('/minha-conta/alterar-email') }}" class="button">Alterar E-mail</a></li>
			        <li><a href="{{ url('/minha-conta/alterar-senha') }}" class="button">Alterar Senha</a></li>
			        <li><a href="{{ url('/minha-conta/alterar-dados-cadastrais') }}" class="button">Alterar Dados</a></li>
			        <li><a href="{{ url('/minha-conta/email-ofertas') }}" class="button">E-mail de ofertas</a></li>
			        <li><a href="{{ url('/minha-conta/meus-enderecos') }}" class="button">Meus endereços</a></li>
		        </ul>
            </div>
        </div>

    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/customer-index.css') }}">
@endpush
