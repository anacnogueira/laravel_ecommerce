<div id="writeComment" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">Escreva seu comentário</h2>
    <p>Os campos com * são obrigatórios</p>
    <div id='make_comment'></div>
    <form action="" method="" id="comment-view-form">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}" />
        <div class='input text'>
            @include("components.rating")
        </div>
        @if(!session()->has('contact'))
            <div class="form-group">
                <label for="name">Nome:*</label>
                <input type="text" name="name" id="name" />
            </div>
            <div class="form-group">
                <label for="email">E-mail:* (não será mostrado)</label>
                <input type="email" name="email" id="email"/>
            </div>
        @else
            <input type="hidden" name="contact_id"  value="" />
        @endif

        <div class="form-group">
            <label for="text">Comentário:*</label>
            <textarea name="text"></textarea>
        </div>
        <div class="submit">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
