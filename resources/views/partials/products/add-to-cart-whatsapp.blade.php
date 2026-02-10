<div class='add-to-cart'>
    <label for="quantity">Qtde:</label>
        <input type="number"
            id="quantity"
            value="1"
            size=2
            min=1
            max={{ $product->current_stock }}
        />
        <button type="button" class="btn-whatsapp">
            <i class="fa-brands fa-whatsapp"></i>
            Comprar por WhatsApp
        </button>

</div>
