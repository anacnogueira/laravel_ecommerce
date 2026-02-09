<div class="products">
    @inject('showPrices', 'App\Services\ProductSellingPriceService')
    @foreach($products as $product)
        @php
            $categories = '';
            foreach ($product->categories as $i => $category) {
                $categories .= Str::slug(strtolower($category->name)).'/';
            }
            $link =  url('/item/'.$categories.$product->permalink);
        @endphp
        <div class="product-item">
            <a href="{{ $link }}">
                @if (count($product->photos) >0)
                    <img
                        src="{{ Storage::url($product->photos[0]->photo_redim) }}"
                        alt="{{ $product->name }}"
                        title="{{ $product->name }}"
                        width="{{ $product->photos[0]->width_redim }}"
                        height ="{{ $product->photos[0]->height_redim }}"
                    />
                @else
                    <img src="{{ asset('images/no_image.jpg') }}" alt="Produto sem imagem" title="Produto sem imagem" />
                @endif

                @if ($product->promotion)
                    <div class='price-off'>{{ $product->promotion->percent_promotion }} % desconto</div>
                @endif

                <h2 class="desc">{{ Str::limit($product->name,40) }}</h2>
                <h3>{{ $product->brand->name ?? '' }}</h3>
                @php
                    $pricePromotion = $product->promotion->price_promotion ?? null;
                @endphp

                {{ $showPrices->returnPrices($product->selling_price, $pricePromotion) }}
            </a>
        </div>
    @endforeach
</div>
