@extends('layouts.app')

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
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <p>Os campos marcados com * são obrigatórios</p>
        <form method="POST" action="{{ route('customers.update-email-newsletter') }}">
            @method('PUT')
            @csrf
           <div class="newsletter form-group">
                <input
                    type="checkbox"
                    name="newsletter"
                    id="newsletter"
                    value="S"
                    {{ (old('newsletter') == "S" || $customer->newsletter == "S") ? "checked" : ""}} />
                    <label for="newsletter">Desejo receber e-mails de promoções da Maya Cosméticos</label>
            </div>
            <input type="submit" value="Enviar" />
        </form>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/customer-edit-email-newsletter.css') }}">
@endpush
