<div class="credit-card-info">
    <ul>
        <li>Preencher os campos abaixo com seus dados.</li>
        <li>O nome informado deve ser exatamente como impresso no cartão.</li>
        <li>Informar um telefone de contato pois, algumas compras exigem confirmação por telefone do comprador.</li>
    </ul>
    <h4>Dados do Cartão de Crédito</h4>
    <ul class="flags">
        <li>
            <img src="{{ asset('img/flags/visa.png') }}" alt="Visa" title="Visa" width="50" />
        </li>
        <li>
            <img src="{{ asset('img/flags/master.png') }}" alt="Mastercard" title="Mastercard" width="50" />
        </li>
        <li>
            <img src="{{ asset('img/flags/american.png') }}" alt="American Express" title="American Express"
                width="50" />
        </li>
        <li>
            <img src="{{ asset('img/flags/hiper.jpeg') }}" alt="Hipercard" title="Hipercard" width="50" />
        </li>
        <li>
            <img src="{{ asset('img/flags/elo.png') }}" alt="Elo" title="Elo" width="50" />
        </li>
    </ul>
    <div class="credit-card-data">
        <div class="credit-card-form">
            <div class="card-number-cvv">
                <div class="form-group" id="cardBrand">
                    <label for="cardNumber">Número do cartão</label>
                    <input type="text" inputmode="numeric" maxlength="19" name="card_number" id="cardNumber"
                        class="credit-card-mask" value="{{ old('card_number') }}" />
                </div>

                <div class="form-group">
                    <label for="cardCvv">Código de Segurança</label>
                    <input type="text" inputmode="numeric" pattern="\d*" maxlength="5" id="cardCvv"
                        name="card_cvv" class="only-number cvv" max="5" value="{{ old('card_cvv') }}" />
                </div>
            </div>

            <div class="card-expiration-installments">
                <div>
                    <label for="cardExpirationMonth">Data de Vencimento </label>
                    <div class="cardExpiration">

                        <div class="form-group">
                            <select id="cardExpirationMonth" name="card_expiration_month" class="month">
                                <option value="">Mês</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    @php
                                        $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                                    @endphp
                                    <option value="{{ $month }}"
                                        {{ old('card_expiration_month') == $month ? 'selected' : '' }}>
                                        {{ $month }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <select id="cardExpirationYear" name="card_expiration_year" class="year">
                                <option value="">Ano</option>
                                @for ($i = date('Y'); $i <= date('Y') + 10; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('card_expiration_year') == $i ? 'selected' : '' }}>{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="installmentsWrapper">
                    <input type="hidden" name="installment_value" id="installmentValue" />
                    <label for="installmentQuantity">Parcelamento</label>
                    <select name="installment_quantity" id="installmentQuantity" class="installments">
                        <option value="">Carregando...</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="holder-card-form">
            <h4>Dados do Titular do Cartão</h4>

            <div id="holderDataChoice">
                <label for="sameHolder">
                    <input type="radio" name="holder_type" value="sameHolder" id="sameHolder"
                        {{ old('holder_type') == 'sameHolder' ? 'checked' : '' }} />
                    Mesmo que o Comprador
                </label>

                <label for="otherHolder">
                    <input type="radio" name="holder_type" value="otherHolder" id="otherHolder"
                        {{ old('holder_type') == 'otherHolder' ? 'checked' : '' }} />
                    Outro
                </label>
            </div>

            <div class="form-group" id="holderData">
                <label for="creditCardHolderName">Nome (Como está impresso no cartão)</label>
                <input type="text" id="creditCardHolderName" name="creditCard_holder_name"
                    value="{{ old('creditCard_holder_name') }}" />
            </div>

            <div class="form-group">
                <label for="creditCardHolderEmail">E-mail</label>
                <input type="text" id="creditCardHolderEmail" name="creditCard_holder_email"
                    value="{{ old('creditCard_holder_email') }}" />
            </div>

            <div class="form-group">
                <label for="creditCardHolderCPF">CPF </label>
                <input type="text" id="creditCardHolderCPF" name="creditCard_holder_cpf" class="cpf-mask"
                    maxlength="11" value="{{ old('creditCard_holder_cpf') }}" />
            </div>

            <div class="phone-birth-date">
                <div class="form-group">
                    <label for="creditCardHolderAreaCode">Telefone</label>
                    <div class="form-group-phone">
                        <input type="text" inputmode="numeric" pattern="\d*" maxlength="2"
                            id="creditCardHolderAreaCode" name="creditCard_holder_area_code" class="ddd-mask"
                            value="{{ old('creditCard_holder_area_code') }}" />

                        <input type="text" inputmode="numeric" id="creditCardHolderPhone"
                            name="creditCard_holder_phone" class="phone-without-ddd-mask" maxlength="10"
                            value="{{ old('creditCard_holder_phone') }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="creditCardHolderBirthDate">Data de Nascimento</label>
                    <input type="date" id="creditCardHolderBirthDate" name="creditCard_holder_birth_date"
                        class="phone-birth-date" value="{{ old('creditCard_holder_birth_date') }}" />
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="creditCard_token" id="payment-token" />
    <input type="hidden" name="creditCard_mask" id="card-mask" />
    <input type="hidden" name="creditCard_brand" id="credit-card-brand" />

    <button type="submit" class="button" id="creditCardButton">Pagar com Cartão de Crédito</button>
</div>
