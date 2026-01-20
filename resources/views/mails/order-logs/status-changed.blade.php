@extends('mails.layouts.default')

@section('title', "Pedido {{ $orderId }} com status {{ $orderStatusName }}")

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
                <td>
                    <h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;"> Seu pedido {{ $orderId }}
                        está com status {{ $orderStatusName }}</h1>
                </td>
            </tr>
            @if(isset($text) && !empty($text))
            <tr>
                <td>{!! $text !!}</td>
            </tr>
            @endif
            <tr>
                <td>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Acompanhe seu pedido</h2>
                    <p>Se preferir, você pode acompanhar o pedido pelo site. </p>
                    <table width="229" border="0" align="center">
                        <tbody>
                            <tr>
                                <td align="center" style="background-color: #cd5c6e; padding: 10px">
                                    <a href="{{ ENV('SITE_URL') }}/pedido/{{ $orderId }}" style="font-family: Arial; color: #ede6e6; font-size: 12px; font-weight: 400; text-decoration:none">Acompanhe seu pedido</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Atendimento</h2>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Você pode entrar em contato conosco através dos canais:</p>
                    <table width="291">
                        <tbody>
                            <tr>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Telefones:</td>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                                    (12)98868-1452
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">E-mail:<br></td>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">atendimento@mayacosmeticos.com.br</td>
                            </tr>
                            <tr>
                                <td style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Site:</td>
                                <td>
                                    <a href="{{ ENV('SITE_URL') }}/contato" style="font-family: Arial; color: #0000ff; font-size: 12px; font-weight: 400;">Fale Conosco</a>
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
