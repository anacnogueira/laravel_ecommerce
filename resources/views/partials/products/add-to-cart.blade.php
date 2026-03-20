<div class='add-to-cart'>
    <form action="{{ route('carts.store') }}" id="frm-add-to-cart" method="post">
        @php
            $cartId = session("cart.".$product->id);
            $quantity = 1;
            if ($cartId){
                $quantity = $cartId['quantity'];
            }
        @endphp
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}" />
        <input type="hidden" name="price" value={{ (isset($product->promotions[0]->price_promotion))
        ? $product->promotions[0]->price_promotion : $product->selling_price }} />
        <input type="hidden" name="price_without_discount" value="{{ $product->selling_price }}" />
        <div class="items">
             <label for="quantity">Qtde:</label>
            <input type="number"
                name="quantity"
                id="quantity"
                value="{{ $quantity }}"
                size=2
                min=1
                max={{ $product->current_stock }}
            />
            <button type="submit" class="button">
                Comprar
            </button>
        </div>
        <div id="quantity-error"></div>
    </form>
</div>
