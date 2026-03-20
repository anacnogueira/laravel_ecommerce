<div class="mini-bag">
    @if ($cart)
        <div class="cart-products">
            @php
                $total = 0;
            @endphp
            @foreach($cart as $key => $item)
                @php
                    $total +=  ($item['quantity'] * $item['price']);
                @endphp
                <div class="cart-item">
                    <div class="cart-item-img">
                        @if (isset($item["image"]))
                            <img
                                src="{{ Storage::url($item["image"][0]->photo_redim) }}"
                                alt="{{ $item["name"] }}"
                                title="{{ $item["name"] }}"
                            />
                        @else
                            <img
                                src="{{ asset("img/no_image.jpg") }}"
                                alt="{{ $item["name"] }}"
                                title="{{ $item["name"] }}"
                            />
                        @endif
                    </div>

                    <div class="cart-item-details">
                        {{ $item["quantity"]  }} X {{  substr($item['name'],0,20)  }} <br>
                        R$ {{ number_format($item['quantity'] * $item['price'],2,',','.') }}
                    </div>
                    <div class="cart-item-buttons">
                        <form method="POST" action="/api/carts/{{ $key }}" class="frm-delete-product-bag">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-product-bag">
                                <i class='fa fa-trash'></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <hr />
        <div class="cart-total">
            SUBTOTAL*: <span>R$ </span> {{ number_format($total,2,',','.') }} <br>
            <span class='warning_cart' >* Não inclui valor do frete</span>
        </div>
        <div class="cart-buttons">
            <a href="{{ url("minha-sacola") }}" class="button">Ver Sacola</a>
        </div>
    @else
        <p>Sua sacola está vazia</p>
    @endif

</div>
