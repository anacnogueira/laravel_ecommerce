<div class='add-to-cart'>
        @php
            //Aqui vai informações do carrinho
            $cartId = 1;
            $quantity = 1;
        @endphp
        <form action="" class="add-to-cart-form" id="cart-view-form" method="post">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <input type="hidden" name="price" value={{ (isset($product->promotions[0]->price_promotion))
            ? $product->promotions[0]->price_promotion : $product->selling_price }} />
            <input type="hidden" name="price_without_discount" value="{{ $product->selling_price }}" />
            <div class="form-group">
                <label for="quantity">Qtde:</label>
                <input type="number"
                    name="quantity"
                    size=2
                    min=1,
                    max={{ $product->current_stock }}
                    value="{{ $quantity}}"
                />
            </div>
            <div class="submit">
                <button type="submit" class="btn btn-primary">Comprar</button>
            </div>
        </form>
    </div>
