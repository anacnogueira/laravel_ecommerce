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
        <form method="POST" action="{{ route('customers.update-email') }}">
            @method('PUT')
            @csrf
           <div class="form-group">
                <label for="email">E-mail:*</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ $customer->email ?? old('email') }}"
                    class="@error('name') is-invalid @enderror">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="submit" value="Enviar" />
        </form>
    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/customer-edit-email.css') }}">
@endpush
