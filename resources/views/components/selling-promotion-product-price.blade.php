<div class='price'>
    @if ($pricePromotion)
        <p>de: <span class='cash-old-price'> R$ {{ $sellingPrice }}</span></p>
        <p>por: <span class='cash-price'>R$ {{ $pricePromotion }}</span></p>
    @else
        <p><span class='cash-price'>R$ {{ $sellingPrice }}</span></p>
    @endif
    <p class='installment'>
        ou 3x R$ {{ $installment }}
    </p>
</div>
