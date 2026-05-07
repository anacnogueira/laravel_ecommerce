@php
    $cart = collect(session('cart', []));
    $totalItemsCart = $cart->sum('quantity');
    $page = 'cart-view';
@endphp

<div class="shipping">
    <span>Calcular Frete e Prazo</span>
    <form action="{{ route('shippings.calculate') }}" id="frm-shipping-calculate" method="post">
        @csrf
        <input type="hidden" name="cart_value" value="{{ $subtotal }}" />
        <input type="hidden" name="quantity" value="{{ $totalItemsCart }}" />
        <input type="hidden" name="sku" value="" />
        <input type="hidden" name="page" value="{{ $page }}" />
        <input type="hidden" name="weight" value="{{ !empty($weight) ? $weight : 1 }}" />
        <input type="hidden" name="length" value="{{ !empty($length) ? $length : env('SHIPPING_LENGTH') }}" />
        <input type="hidden" name="height" value="{{ !empty($height) ? $height : env('SHIPPING_HEIGHT') }}" />
        <input type="hidden" name="width" value="{{ !empty($width) ? $width : env('SHIPPING_WIDTH') }}" />
        <div class="frm-components">
            <div class="form-group">
                <input type="text" required placeholder="Informe o CEP" name="cep" value="{{ session('cep') }}"
                    class="cep-mask" />
            </div>
            <div class="submit">
                <button type="submit" class="button">Calcular</button>
            </div>
        </div>

    </form>

    <div id="shipping-options"></div>
</div>
