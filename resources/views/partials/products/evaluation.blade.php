   <div>
    <div id="rate">
        <form action="" method="post" id="rating">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            @include('components.rating')
        </form>
        <div class='rate'></div>
    </div>
    <div>
        <ul class="inline-list fontawesome-icon-list">
            @if(count($comments) > 0)
                <li><span href="#show_comments"><i class="fa fa-comments"></i> Ver Avaliação de clientes ({{ count($comments) }})</a></li>
            @endif
          <li><a href="#" data-reveal-id="writeComment"><i class="fa fa-pencil-square"></i> Faça sua avaliação</a></li>
        </ul>
         @include('partials.comments.site-form')
    </div>
</div>
