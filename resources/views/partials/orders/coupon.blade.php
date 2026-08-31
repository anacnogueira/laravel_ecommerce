<div class="coupon-wrap">
    <p>Informe o código do cupom resgatado no campo abaixo. Observe a validade do cupom.</p>
    <div class="form-coupon-wrap">
        <div class="form-group">
            <input type="text" name="code" id="couponCode" placeholder="Informe o cupom" value="{{ $couponCode }}" />
            <span id='couponStatus'></span>
        </div>

        <div class="submit">
            <button type="button" id="applyCoupon" class="button">Aplicar</button>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/orders/coupon-apply.js') }}"></script>
@endpush
