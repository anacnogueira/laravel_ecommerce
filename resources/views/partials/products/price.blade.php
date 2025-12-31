@if ($product->current_stock > 0 && $product->status == 'S')
    @if (count($product->promotions) > 0)
        <p class="old-price">
            R$ {{ number_format($product->selling_price,2,',','.')}}
        </p><br>
        <h3 class='price' itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
            <meta itemprop="priceCurrency" content="BRL" />
            <meta itemprop="price" content="{{ $product->promotions[0]->price_promotion }}" />
            R$ {{ number_format($product->promotions[0]->price_promotion,2,',','.') }}
        </h3>
        <span class='installment'>
            ou 3x {{ number_format(($product->promotions[0]->price_promotion/3),2,',','.') }}
        </span>
    @else
        <h3 class='price' itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
            <meta itemprop="priceCurrency" content="BRL" />
            <meta itemprop="price" content="{{ $product->selling_price }}" />
            R$ {{ number_format($product->selling_price,2,',','.') }}
        </h3>
        <span class='installment'>
            ou 3x {{ number_format(($product->selling_price/3),2,',','.') }}
        </span>
    @endif
    @include('partials.products.add-to-cart-whatsapp')
 @else
    @include('partials.products.unavailable')
@endif
