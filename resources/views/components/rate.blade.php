<div id="rate">
    <div class="stars">
        <form action="{{ route('comments.rate') }}" method="post" id="frm-product-rate">
            <input type="hidden" name="product_id" value="{{ $productId }}" />
            <select class="star-rating" name="rate" id="select-rate">
                @foreach ($stars as $key => $value)
                    <option value="{{ $key }}" >{{ $value }}</option>
                @endforeach
            </select>
        </form>
        <div id='response-rate'></div>
    </div>
    <div class="see-comments-link">
        @if ($comments->count() > 0)
            <a href="#show-comments"><i class="fa fa-comments"></i> Ver avaliações de clientes({{ $comments->count() }})</a>
        @endif
    </div>
    <div class="make-comment">
        <button id="btn-write-comment">
            <i class="fa fa-pencil-square"></i> Faça sua avaliação
        </button>
        @include("partials.comments.site-form")

    </div>

</div>

<div id="response-comment"></div>
