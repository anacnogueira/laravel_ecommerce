@extends('layouts.app')

@section('meta')
    <meta name="robots" content="nofollow, noindex" />
@endsection

@php
    $subtotal = 0;
    $weight = 0;
@endphp

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        @if ($carts)
            <h1>{{ $title }}</h1>
            <div class="cart-content">
                <div class="cart-items">
                    <input type="hidden" id="carts" value="{{ json_encode($carts) }}" />
                    <form action="{{ route('cart.update') }}" id="frm-cart-update" method="POST">
                        @csrf
                        @method('PUT')

                        @foreach ($carts as $productId => $cart)
                            @php
                                $multiplyPriceByQuantity = $cart['quantity'] * $cart['price'];
                                $subtotal += $multiplyPriceByQuantity;
                                $multiplyWeightByQuantity = $cart['quantity'] * $cart['weight'];
                                $weight += $multiplyWeightByQuantity;
                            @endphp
                            <input type="hidden" name="product_id[{{ $productId }}]" value="{{ $productId }}" />
                            <input type="hidden" name="price_without_discount[{{ $productId }}]"
                                value="{{ $cart['price_without_discount'] }}" />

                            <div class="cart-item">
                                <img src="{{ Storage::url($cart['image'][0]->photo_redim) }}" alt="{{ $cart['name'] }}"
                                    title="{{ $cart['name'] }}" style="width: 80px;" />
                                <div class="cart-item-info">
                                    <h2>{{ $cart['name'] }}</h2>
                                    <h3>{{ $cart['brand_name'] }}</h3>
                                </div>
                                <div class="cart-item-buttons">
                                    <button type="submit" form="delete-form-{{ $productId }}" class="btn-remove-item"
                                        title="Remover">
                                        <i class='fa fa-trash'></i>
                                    </button>
                                    <div class='checkbox'>
                                        <label>
                                            <input type="checkbox" name="gift[{{ $productId }}]" class="input-gift"
                                                value="1" {{ $cart['gift'] ? 'checked' : '' }} />
                                            <i class='fa fa-gift' title='Embrulhar para presente?'></i></label>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="cart-item-amount">
                                <input type="number" name="quantity[{{ $productId }}]" min="1"
                                    max="{{ $cart['stock'] }}" class="input-quantity" value="{{ $cart['quantity'] }}" />
                                <div class="cart-item-price">
                                    {{ number_format($multiplyPriceByQuantity, 2, ',', '.') }} <br />
                                    ou 3x de {{ number_format($multiplyPriceByQuantity / 3, 2, ',', '.') }} sem juros
                                </div>
                            </div>
                        @endforeach
                    </form>
                    @foreach ($carts as $productId => $cart)
                        <form id="delete-form-{{ $productId }}" action="{{ route('cart.destroy', $productId) }}"
                            method="POST" class="frm-cart-delete">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach

                    @include('components.shipping-cart')
                </div>
                <div class="cart-summary">
                    <div class="subtotal-info">
                        <span>SUBTOTAL:</span>
                        <span id="subtotal-amount" data-subtotal="{{ $subtotal }}">R$
                            {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                    <div class="shipping-info">
                        <span>FRETE:</span>
                        <span id="shipping-amount" data-shipping="0">R$ 0,00</span>
                    </div>
                    <div class="discount-info">
                        <span>DESCONTO:</span>
                        <span id="discount-amount" data-discount="0">R$ 0,00</span>
                    </div>
                    <div class="total-info">
                        <span>TOTAL:</span>
                        <span id="total-amount" data-total="{{ $subtotal }}">R$
                            {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>

                    <div class="cart-buttons-desktop">
                        <a href="/" class="button">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>Continuar comprando
                        </a>
                        @include('partials/cart/btn-checkout')
                    </div>
                </div>
            </div>


            <div class="cart-buttons">
                <a href="/" class="button">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Continuar comprando
                </a>
                @include('partials/cart/btn-checkout')
            </div>
        @else
            <h1>Sacola vazia :(</h1>
            <img src="{{ asset('img/empty_bag.jpg') }}" alt="Sacola Vazia" title="SAcola Vazia" />
            <p>Ei gata, sua sacola não tem produtos, que tal ir as compras?</p>
            <a href="/" class="button">Adicionar Produtos</a>
        @endif
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/page/cart-show.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/components/shipping-calculate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/cart/update.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/utils/checkout.js') }}"></script>
    <!--script type="text/javascript" src="{{ asset('js/cart/checkout-whatsapp.js') }}"></script-->
@endpush
