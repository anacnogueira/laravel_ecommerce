@if ($paymentMethods->isEmpty())
    <p class="panel alert">Nenhum método de pagamento disponível no momento.</p>
@else
    <div class="payment-tabs">
        @foreach ($paymentMethods as $index => $method)
            <input type="radio" name="payment_method_id" id="tab-{{ $method['value'] }}" class="payment-radio"
                value="{{ $method['id'] }}" data-value="{{ $method['value'] }}"
                {{ old('payment_method_id') == $method['id'] ? 'checked' : '' }} />
        @endforeach

        <div class="tabs-nav">
            @foreach ($paymentMethods as $index => $method)
                <label for="tab-{{ $method['value'] }}" class="tab-label">
                    <i class="{{ $method['icon'] }}"></i>
                    {{ $method['name'] }}
                </label>
            @endforeach
        </div>

        <div class="tabs-content">
            @foreach ($paymentMethods as $index => $method)
                <div class="tab-pane" id="content-{{ $method['value'] }}">
                    @include('partials.orders.payment-' . $method['value'])
                </div>
            @endforeach
        </div>
    </div>
@endif
