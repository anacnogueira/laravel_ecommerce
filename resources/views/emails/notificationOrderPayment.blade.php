@extends('emails.layouts.default')

@section('title', 'Notificação de Novo Pedido')

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">Notificação do pedido </h1>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Nº Pedido: {{ $order->id }}</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Status: {{ $order->orderStatus->name }}</p>
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Nome:  {{ $order->contact->name }}</p>
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Pagamento:  {{ $paymentMethod }}</p>       			
      			</td>
    		</tr>    		
  		</tbody>
	</table>
@endsection