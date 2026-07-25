@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('cart.show') }}">Minha Sacola</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        @if ($carts)
            <h1>
                <a href="{{ route('cart.show') }}" title="Voltar para a sacola"><i class="fa fa-arrow-left"
                        aria-hidden="true"></i></a>
                {{ $title }}
            </h1>
            <form action="{{ route('orders.store') }}" method="POST" id="frm-checkout">
                @csrf
                <input type="hidden" name="quantity" value="{{ $quantity }}">
                <input type="hidden" name="weight" value="{{ $weight }}">

                <!-- Carrrinho -->
                <div class="cart-items">
                    @foreach ($carts as $productId => $cart)
                        <div class="cart-item">
                            <img src="{{ Storage::url($cart['image'][0]->photo_redim) }}" alt="{{ $cart['name'] }}"
                                title="{{ $cart['name'] }}" style="width: 80px;" />
                            <div class="cart-item-info">
                                <h2>{{ $cart['name'] }}</h2>
                                <h3>{{ $cart['brand_name'] }}</h3>
                                <strong>Presente: </strong> {{ $cart['gift'] ? 'Sim' : 'Não' }} <br />
                                <strong>Valor unitário: </strong> R$ {{ number_format($cart['price'], 2, ',', '.') }}
                                <br />
                                <strong>Quantidade: </strong> {{ $cart['quantity'] }} <br />
                                <strong>Subtotal: </strong> R$
                                {{ number_format($cart['price'] * $cart['quantity'], 2, ',', '.') }} <br />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="cart-summary">
                    <div class="subtotal-info">
                        <span id="subtotal-amount" data-subtotal="{{ $subtotal }}">SUBTOTAL:</span>
                        <span>R$ {{ number_format($subtotal, 2, ',', '.') }}</span>
                    </div>
                    <div class="shipping-info">
                        <span>FRETE:</span>
                        <span id="shipping-amount">R$ 0,00</span>
                    </div>
                    <div class="discount-info">
                        <span>DESCONTO:</span>
                        <span id="discount-amount">R$ 0,00</span>
                    </div>
                    <div class="total-info">
                        <span>TOTAL:</span>
                        <span id="total-amount" data-total="{{ $subtotal }}">
                            R$ {{ number_format($subtotal, 2, ',', '.') }}
                        </span>
                    </div>
                </div>

                <x-errors />
                <!-- Endereço de Entrega -->
                <div class="address">
                    <h2><i class="fa fa-home" aria-hidden="true"></i> 1. Endereço de Entrega</h2>
                    @if ($address)
                        <div class="address-item">
                            <input type="radio" name="contact_address_id" value="{{ $address->id }}" checked />
                            <div class="adress-item-info">
                                <p><strong>{{ $address->title }}</strong></p>
                                <p>{{ $address->address }}, {{ $address->number }}</p>
                                @if (!empty($address->complement))
                                    <p>{{ $address->complement }}</p>
                                @endif
                                <p>{{ $address->neighborhood }}</p>
                                <p>CEP: <span id="cep-selected">{{ $address->cep }}</span></p>
                                <p>{{ $address->city->name }} - {{ $address->state->uf }} - {{ $address->country->name }}
                                </p>
                            </div>
                        </div>
                        <p><a href="{{ route('customers.addresses.index', 'redirect=checkout') }}" class="button">Usar
                                outro
                                endereço</a></p>
                    @else
                        <p>Nenhum endereço de entrega cadastrado.</p>
                        <p><a href="{{ route('customers.addresses.create', 'redirect=checkout') }}"
                                class="button">Cadastrar endereço</a></p>
                    @endif

                </div>
                <!-- Frete -->
                <div class="shipping">
                    <h2><i class="fa fa-truck" aria-hidden="true"></i> 2. Opções de Entrega</h2>
                    <x-shipping-options :shippings="$shippings" page="cart-view" />
                </div>
                <!-- Forma de Pagamento -->
                <div class="payment">
                    <h2><i class="fa fa-credit-card" aria-hidden="true"></i> 3. Formas de Pagamento</h2>
                    @include('partials.orders.payment-methods')
                </div>

            </form>
        @else
            <h1>Sacola vazia :(</h1>
            <img src="{{ asset('img/empty_bag.jpg') }}" alt="Sacola Vazia" title="Sacola Vazia" />
            <p>Ei gata, sua sacola não tem produtos, que tal ir as compras?</p>
            <a href="/" class="button">Adicionar Produtos</a>
        @endif
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/page/order-checkout.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript">
        const EFI_ACCOUNT_IDENTIFIER = "{{ env('EFI_ACCOUNT_IDENTIFIER') }}";
        const EFI_ENVIRONMENT = "{{ env('EFI_ENVIRONMENT') }}";
    </script>
    <script type="text/javascript" src="{{ asset('js/components/shipping-calculate.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js"
        integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/gh/efipay/js-payment-token-efi/dist/payment-token-efi-umd.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/orders/credit-card-payment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/orders/validate-form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/orders/do-payment.js') }}"></script>
@endpush
