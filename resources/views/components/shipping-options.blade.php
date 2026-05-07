@props(['shippings', 'page'])
<div id="shipping-info">

    @if (isset($shippings) && is_array($shippings) && count($shippings) > 0)
        <table id="tbl-shipping-info">
            <thead>
                <tr>
                    <th>Entrega</th>
                    <th>Frete</th>
                    <th>Prazo</th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" name="value_shipping" id="value-shipping" />
                <input type="hidden" name="delivery_time" id="delivery-time" />

                @foreach ($shippings as $key => $shipping)
                    <tr>
                        <td>
                            @if ($page == 'cart-view')
                                <label>
                                    <input type="radio" name="type_shipping" value="{{ $shipping['type'] }}"
                                        data-value="{{ $shipping['valorFrete'] }}"
                                        data-delivery-time="{{ $shipping['PrazoEntrega'] }}"
                                        {{ old('shipping') == $shipping['type'] ? 'checked' : '' }} />
                                    {{ $shipping['nome'] }}
                                </label>
                            @else
                                {{ $shipping['nome'] }}
                            @endif
                        </td>
                        <td>R$ {{ number_format($shipping['valorFrete'], 2, ',', '.') }}</td>
                        <td>{{ $shipping['PrazoEntrega'] }} dias úteis</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @else
        <div id="shipping-error" class="panel alert">Não foi possível calcular o frete.</div>
    @endif
</div>
