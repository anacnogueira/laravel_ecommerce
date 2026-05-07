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
        <div class="filters">
            <form name="frm_address" method="get">
                <div class="form-group">
                    <label for="cep">CEP:</label>
                        <input
                            type="text"
                            name="cep"
                            class="cep-mask"
                            id="order-id"
                            value="{{ request()->query("cep") }}"
                            required
                        />
                </div>

                <input type="submit" value="Filtrar" />
            </form>

            <a href="{{ route('customers.addresses.create') }}" class="button">
                <i class="fa fa-lg fa-fw fa-file"></i>
                Adicionar Endereço
            </a>

            @if ($addresses->count() > 0)
                <p class="counter">Total de  {{ $addresses->count() }} endereços encontrados </p>
                 @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="address-container">
                    @foreach ($addresses as $address)
                        <div class="address-item">
                            @if (session('redirect'))
                                <input type="radio" name="address_id" value="{{ $address->id }}" />
                            @endif
                            <div class="address-details">
                                <h2>{{ $address->title }}</h2>
                                {{ $address->contact }}<br>
                                {{ $address->address }}, {{ $address->number }}<br>
                                @if ($address->complement)
                                    {{ $address->complement }}<br>
                                @endif
                                {{ $address->neighborhood }}<br>
                                CEP: {{ $address->cep }}<br>
                                {{ $address->city->name }} - {{$address->state->uf }}<br>
                                {{ $address->country->name }}<br>
                            </div>
                            <div class="buttons">
                                <a href="{{ route('customers.addresses.edit', $address->id) }}" class="button edit">
                                    <i class="fa fa-lg fa-fw fa-edit"></i>
                                    Alterar
                                </a>
                                <form action="{{ route('customers.addresses.destroy', $address->id) }}" method="POST" class="frm-delete" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button delete" title="Excluir">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>

                    @endforeach
                </div>
            @else
                <div>
                    <p class="panel alert">Nenhum Endereço Encontrado</p>
                </div>
            @endif
        </div>


    </div>

@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/address-index.css') }}">
@endpush

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/utils/get-address-by-id.js') }}"></script>
@endpush

