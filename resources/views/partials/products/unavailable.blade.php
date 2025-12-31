<div class="unavailable">
    <h3>Produto Indisponível</h2>
    <div>
        <p>Deseja receber um e-mail quando este item estiver disponível novamente?</p>
        <form action="/api/product-notification" id="product-notification" method="post" class="add-notification">
            @csrf
            <input type="hidden" id="product-id" value="{{ $product->id }}" />
            <div class="form-group">
                 <label for="name">Nome:</label>
                <input type="text" id="name" placeholder="Informe o nome" required />
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" placeholder="Informe o e-mail" required />
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>

