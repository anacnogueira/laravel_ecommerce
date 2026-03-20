@if ($product->current_stock > 0 && $product->status == 'S')
    @if ($product->promotion)
        <p>
            De: <span class="cash-old-price">R$ {{ number_format($product->selling_price,2,',','.')}}</span>
        </p>
        Por: <h3 itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
            <meta itemprop="priceCurrency" content="BRL" />
            <meta itemprop="price" content="{{ $product->promotions[0]->price_promotion }}" />
            <span class='cash-price'>R$ {{ number_format($product->promotion->price_promotion,2,',','.') }}</span>
        </h3><br>
        <span class='installment'>
            ou 3x {{ number_format(($product->promotion->price_promotion/3),2,',','.') }}
        </span>
    @else
        <h3 class='cash-price' itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
            <meta itemprop="priceCurrency" content="BRL" />
            <meta itemprop="price" content="{{ $product->selling_price }}" />
            R$ {{ number_format($product->selling_price,2,',','.') }}
        </h3>
        <span class='installment'>
            ou 3x {{ number_format(($product->selling_price/3),2,',','.') }}
        </span>
    @endif
    @include('partials.products.add-to-cart')
 @else
    @include('partials.products.unavailable')
@endif
