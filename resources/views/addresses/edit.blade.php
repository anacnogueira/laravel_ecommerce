@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="{{ route('index') }}"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('customer.index') }}">Minha Conta</a></li>
            <li><a href="{{ route('customers.addresses.index') }}">Meus Endereços</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        <form method="POST" action="{{ route('customers.addresses.update', $address->id) }}">
            @method('PUT')
            <p>Os campos com * são obrigatórios</p>
            @include('addresses.partials.form')
        </form>
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/address-create.css') }}">
@endpush

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
    <script type="module" src="{{ asset('js/utils/get-address.js') }}"></script>
@endpush
