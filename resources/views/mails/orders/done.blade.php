@extends('mails.layouts.default')

@section('title', "Confirmação de pedido {{ $order->id }}")

@section('content')
    <table width="520" border="0">
        <tbody>
            <tr>
                <td>
                    <h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;"> Recebemos seu pedido
                        {{ $order->id }}</h1>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Olá
                        {{ $order->customer->name }},</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Seu pedido de número
                        {{ $order->id }} foi realizado com sucesso, estamos aguardando confirmação do pagamento
                    </p>
                    <p style="font-family: Arial; color: #000000;font-size: 12px; font-weight: 400;">Você receberá novos
                        comunicados por e-mail, sobre o andamento do pedido</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;"><b>Prazo de
                            entrega:</b> Começa a contar a partir da data de confirmação do pagamento</p>
                </td>
            </tr>
            @if ($order->orderStatus->value == 'pending_payment')
                @if ($order->paymentMethod->value == 'boleto')
                    <tr>
                        <td>
                            <p>Só falta pagar seu boleto</p>
                            <div align="center"
                                style="background-color: #cd5c6e; padding: 10px; width: 229px; margin: 0 auto;">
                                <a href="{{ $order->transaction->payment_link }}"
                                    style="font-family: Arial; color: #ede6e6; font-size: 12px; font-weight: 400; text-decoration:none">Pagar
                                    Boleto</a>
                            </div>
                        </td>
                    </tr>
                @elseif ($order->paymentMethod->value == 'pix')
                    <tr>
                        <td align="center">
                            <h2 style="font-family: Arial; color: #a61922; font-size: 14px; font-weight: 400;">Código Pix -
                                Copia e Cola</h2>
                            <textarea style="resize: none;" cols="80" rows="3" readonly>{{ $order->orderPix->qrcode }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <h2 style="font-family: Arial; color: #a61922; font-size: 14px; font-weight: 400;">QR
                                Code Pix -
                                Aponte a Câmera para o QR Code</h2>
                            <img src="{{ $order->orderPix->qrcode_image }}" title="QR Code" width="200" height="200">
                        </td>
                    </tr>
                @endif
            @endif

            <tr>
                <td>
                    <br>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Informação do pedido
                    </h2>
                    <table width="520" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="235"
                                    style="font-weight: bolder; border-bottom: 3px solid #454545;  border-collapse:collapse; border-spacing:0;">
                                    PRODUTO</th>
                                <th width="164"
                                    style="font-weight: bolder; border-bottom: 3px solid #454545;  border-collapse:separate; border-spacing: 0;">
                                    ENTREGA</th>
                                <th width="54"
                                    style="font-weight: bolder; border-bottom: 3px solid #454545;  border-collapse:separate; border-spacing:5px 5px;">
                                    QTDE</th>
                                <th width="54"
                                    style="font-weight: bolder; border-bottom: 3px solid #454545;  border-collapse:separate; border-spacing:5px 5px;">
                                    PRESENTE</th>
                                <th width="67"
                                    style="font-weight: bolder; border-bottom: 3px solid #454545;  border-collapse:separate; border-spacing:5px 5px;">
                                    VALOR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td
                                        style="color: #000000; font-size:10px; font-weight: 400; font-family: Arial; border-right:1px dotted #454545;padding: 0 4px 0 4px">
                                        {{ $item->product->name }} - {{ $item->product->brand->name }}
                                    </td>
                                    <td
                                        style="color: #000000; font-size:10px; font-weight: 400; font-family: Arial; border-right:1px dotted #454545;padding: 0 4px 0 4px">
                                        {{ $item->order->delivery_time }} dias úteis a contar após confirmação do pagamento
                                    </td>
                                    <td
                                        style="color: #000000;font-size: 10px;font-weight: 400; font-family: Arial; border-right:1px dotted #454545; padding: 0 4px 0 4px">
                                        {{ $item->quantity }}</td>
                                    <td
                                        style="color: #000000;font-size: 10px;font-weight: 400; font-family: Arial; border-right:1px dotted #454545; padding: 0 4px 0 4px">
                                        {{ $item->gift ? 'Sim' : 'Não' }}</td>
                                    <td
                                        style="color: #000000; font-size:10px; font-weight: 400; font-family: Arial; padding: 4px 0 4px 0">
                                        R$
                                        {{ $item->value_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="520">
                        <tr>
                            <td width="459" style="border-top: 1px solid #454545;">&nbsp;</td>
                            <td width="61" style="border-top: 1px solid #454545;border-spacing:5px 5px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="459" align="right"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial; border-bottom:1px dotted #454545;  padding-right: 10px;">
                                Subtotal
                            </td>
                            <td width="61"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial;border-bottom:1px dotted #454545; padding-right: 10px; ">
                                R$ {{ number_format($order->value, 2, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td width="459" align="right"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial; border-bottom:1px dotted #454545; padding-right: 10px;">
                                Frete</td>
                            <td width="61"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial; border-bottom:1px dotted #454545; padding-right: 10px;">
                                R$ {{ $order->value_shipping }}
                            </td>
                        </tr>
                        <tr>
                            <td width="459" align="right"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial; border-bottom:1px dotted #454545;  padding-right: 10px;">
                                Desconto
                            </td>
                            <td width="61"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial;border-bottom:1px dotted #454545; padding-right: 10px; ">
                                R$ {{ number_format($order->value_discount, 2, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td width="459" align="right"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial;padding-right: 10px; border-bottom:1px dotted #454545; padding-right: 10px">
                                Valor Total do Pedido</td>
                            <td width="61"
                                style="color: #000000; font-size: 10px; font-weight: 400; font-family: Arial; border-bottom:1px dotted #454545; ">
                                R$
                                {{ number_format($order->value + $order->value_shipping - $order->value_discount, 2, ',', '.') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Endereço de Entrega
                    </h2>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;padding: 11px">
                        {{ $shipping }}
                    </p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;padding: 11px">
                        {{ $order->address->address }} , {{ $order->address->number }} <br>
                        @if (!empty($order->address->complement))
                            {{ $order->address->complement }} -
                        @endif
                        {{ $order->address->neighborhood }} <br>
                        CEP: {{ $order->address->cep }} <br>
                        {{ $order->address->city->name }} - {{ $order->address->state->uf }} -
                        {{ $order->address->country->name }} <br>
                        @if (!empty($order->address->phone))
                            Tel Contato: {{ $order->address->phone }}
                        @endif
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Entenda o prazo de
                        entrega</h2>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">O prazo de entrega é
                        contado em dias úteis, ou seja, não inclui sábados, domingos e feriados.</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Dias úteis para
                        entrega: de segunda a sexta-feira, das 8h às 21h.
                    </p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400; font-style:italic">
                        Excepcionalmente, entregas podem ocorrer aos sábados, domingos e feriados.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Forma de pagamento</h2>
                    <table>
                        <tr>
                            <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                                {{ $order->paymentMethod->name }}</td>
                            <td></td>
                            <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Acompanhe seu
                        pedido
                    </h2>
                    <p>Se preferir, você pode acompanhar o pedido pelo site. </p>
                    <table width="229" border="0" align="center">
                        <tbody>
                            <tr>
                                <td align="center" style="background-color: #cd5c6e; padding: 10px">
                                    <a href="{{ env('SITE_URL') }}pedido/{{ $order->id }}"
                                        style="font-family: Arial; color: #ede6e6; font-size: 12px; font-weight: 400; text-decoration:none">Acompanhe
                                        seu pedido</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Atendimento
                    </h2>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Você pode
                        entrar em
                        contato conosco através dos canais:</p>
                    <table width="291">
                        <tbody>
                            <tr>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                                    Telefone
                                    (Whatsapp):</td>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                                    {{ env('SELLER_PHONE') }}<br>
                                </td>
                            </tr>

                            <tr>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                                    Site:
                                </td>
                                <td>
                                    <a href="{{ env('SITE_URL') }}/contato"
                                        style="font-family: Arial; color: #0000ff; font-size: 12px; font-weight: 400;">Fale
                                        Conosco</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
