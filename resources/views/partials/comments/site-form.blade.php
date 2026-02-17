<div id="write-comment">
    <div class="write-comment-content">
        <span class="modal-close">&times;</span>
        <h2 id="modalTitle">Escreva seu comentário</h2>
        <p>Os campos com * são obrigatórios</p>
        <div id='make_comment'></div>
        <form action="{{ route('comments.store') }}" method="post" id="frm-product-comment">
            @csrf
            <input type="hidden" name="product_id" value="{{ $productId }}" />
            <div>
                <select class="star-rating" name="rate">
                    @foreach ($stars as $key => $value)
                        <option value="{{ $key }}" >{{ $value }}</option>
                    @endforeach
                </select>
                <div id="rate-error"></div>
            </div>
            @guest
                 <div class="form-group">
                    <label for="name">Nome:*</label>
                    <input type="text" name="name" id="name" />
                    <div id="name-error"></div>
                </div>
                <div class="form-group">
                    <label for="email">E-mail:* (não será mostrado)</label>
                    <input type="email" name="email" id="email"/>
                    <div id="email-error"></div>
                </div>
            @endguest
            <div class="form-group">
                <label for="text">Comentário:*</label>
                <textarea name="text"></textarea>
                <div id="text-error"></div>
            </div>

            <button type="submit" class="button">Enviar</button>
        </form>
    </div>
</div>
