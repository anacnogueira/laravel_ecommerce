<form action="{{ route('customer.products.favorite.store') }}" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{ $productId }}" />
    <input type="hidden" name="url" value="{{ $url }}" />
    <input type="hidden" name="status" value="{{ $status }}" />
    <button type="submit" class="btn-favorite">
        @if ($status == 'S')
            <i class="fa-regular fa-heart"></i> Favoritar
        @else
            <i class="fa-solid fa-heart"></i> Desfavoritar
        @endif
    </button>
</form>

