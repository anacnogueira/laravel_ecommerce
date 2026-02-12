<div class=shipping>
    <span>Calcular Frete e Prazo</span>
    <form action="{{ route('shippings.calculate') }}" id="frm-shipping-calculate" method="post">
        @csrf
        <input type="hidden" name="cart_value" value="{{ $product->promotion->price_promotion ?? $product->selling_price }}" />
        <input type="hidden" name="quantity" value="1" />
        <input type="hidden" name="sku" value="{{ $product->code }}" />
        <input type="hidden" name="page" value="product-view" />
        <input type="hidden" name="weight" value="{{ !empty($product->gross_weight) ? str_replace(",",'.',$product->gross_weight) : 1 }}" />
        <input type="hidden" name="length" value="{{ (!empty($product->length) ? $product->length: env('SHIPPING_LENGTH')) }}" />
        <input type="hidden" name="height" value="{{ (!empty($product->height) ? $product->height : env('SHIPPING_HEIGHT')) }}"  />
        <input type="hidden" name="width" value="{{ (!empty($product->width) ? $product->width :  env('SHIPPING_WIDTH')) }}" />
        <div class="frm-components">
            <div class="form-group">
            <input type="text"
                required
                placeholder="Informe o CEP"
                name="cep"
                value="{{ session('cep') }}"
                class="cep-mask"
            />
        </div>
        <div class="submit">
            <button type="submit" class="button">Calcular</button>
        </div>
        </div>

    </form>
    <div id="shipping-info">
        <p><strong>Opções de Entrega</strong></p>
        <table id="tbl-shipping-info">
            <thead>
                <tr>
                    <th>Entrega</th>
		            <th>Frete</th>
		        	<th>Prazo</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <div id="shipping-error" class="panel alert"></div>
    </div>
</div>
