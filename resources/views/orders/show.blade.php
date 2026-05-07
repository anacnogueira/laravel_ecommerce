@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('customer.index') }}">Minha Conta</a></li>
            <li><a href="{{ route('orders.index') }}">Meus Pedidos</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
        <span id="order-id">{{ $order->id }}</span>
        <div class="order">
            <div class="details-delivery">
                <div class="details">
                    <dl>
                        <dt>Data:</dt>
                        <dd>{{ $order->created_formatted }}&nbsp;</dd>
                        <dt>Entrega:</dt>
                        <dd>{{ $order->shipping }}&nbsp;</dd>
                        <dt>Total:</dt>
                        <dd>{{ number_format($order->value_total) }}&nbsp;</dd>
                        <dt>Pagamento:</dt>
                        <dd>{{ $order->paymentMethod->name }}&nbsp;</dd>
                        <dt>Status:</dt>
                        <dd>{{ $order->orderStatus->name }}&nbsp;</dd>
                        @if (!empty($order->tracking_code))
                            <dt>Código de rastreio</dt>
                            <dd>{{ $order->tracking_code }}</dd>
                        @endif
                    </dl>
                </div>

                <div class="delivery-address">
                    <h2>Endereço de Entrega</h2>

                    {{ $order->address->address }}, {{ $order->address->number }} <br>
                    @if (!empty($order->address->complement))
                        {{ $order->address->complement }} -
                    @endif
                    {{ $order->address->neighborhood }} <br>
                    CEP: {{ $order->address->cep }} <br>
                    {{ $order->address->city->name }} - {{ $order->address->state->uf }} -
                    {{ $order->address->country->name }} <br>
                    @if (!empty($order->address->phone))
                        {{ $order->address->phone }}
                    @endif
                </div>
            </div>
            @if ($order->orderStatus->value == 'pending_payment')
                <div class="payment-info">
                    @if ($order->paymentMethod->value == 'boleto')
                        <a href="{{ $order->transaction->payment_link }}" class="button" target="_blank">Pagar
                            Boleto</a>
                    @elseif ($order->paymentMethod->value == 'pix')
                        @include('partials.orders.pix-info')
                    @endif
                </div>
            @endif

            <div class="order-items">
                <h2>Produtos</h2>
                @php
                    $subtotal = 0;
                @endphp
                <div class="order-item-container">
                    @foreach ($order->orderItems as $item)
                        @php
                            $subtotal += $item->value_total;
                        @endphp
                        <div class="order-item-item">
                            <buttom class="item-product">
                                <h3>
                                    <i class='fa fa-chevron-down arrow'></i>
                                    {{ $item->product->name }} - {{ $item->product->brand->name }}
                                </h3>
                            </buttom>
                            <div class='item-product-detail'>
                                <dl>
                                    <dt>Código:</dt>
                                    <dd>{{ $item->product->code }}&nbsp;</dd>
                                    <dt>Quantidade:</dt>
                                    <dd>{{ $item->quantity }}&nbsp;</dd>
                                    <dt>Presente:</dt>
                                    <dd>{{ $item->gift ? 'Sim' : 'Não' }}&nbsp;</dd>
                                    <dt>Valor Unitário:</dt>
                                    <dd>{{ $item->value_unit }}&nbsp;</dd>
                                    <dt>Valor Total:</dt>
                                    <dd>{{ number_format($item->value_total, 2, ',', '.') }}&nbsp;</dd>
                                </dl>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="totals">
                <div>SUBTOTAL: R$
                    <span>
                        {{ number_format($order->value + $order->value_discount, 2, ',', '.') }}
                    </span>
                </div>
                <hr>
                <div>
                    FRETE: R$
                    <span>
                        {{ number_format($order->value_shipping, 2, ',', '.') }}
                    </span>
                </div>
                <hr>
                <div>
                    DESCONTO: R$
                    <span>
                        {{ number_format($order->value_discount, 2, ',', '.') }}
                    </span>
                </div>
                <hr>
                <div>
                    TOTAL: R$
                    <span>
                        {{ number_format($order->value_total, 2, ',', '.') }}
                    </span>
                </div>
                <hr>
            </div>
            <a href="{{ route('orders.index') }}" class="button">&laquo; Voltar</a>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/page/order-show.css') }}">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('js/order-show-accordeon.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/orders/pix.js') }}"></script>
@endpush
