<div class='action_buttons'>
    @inject('favorite', 'App\Services\FavoriteService')
    @php
        $favoriteButton = $favorite->returnShowCurrent($product->status, $product->id, $url);
    @endphp
    <ul>
        <li>{{  $favoriteButton }}</li>
        <li><a href="#" id="share-button"><i class="fa-brands fa-facebook-square"></i> Compartilhar</a></li>
        <li>
            <a data-pin-do="buttonBookmark" data-pin-round="true" href="https://www.pinterest.com/pin/create/button/"><i class="fa-brands fa-pinterest"></i> Salvar</a>
        </li>
        <li><a href="javascript:print();"><i class="fa fa-print"></i> Imprimir</a></li>
    </ul>
</div>
