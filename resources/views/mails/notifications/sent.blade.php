@extends('mails.layouts.default')

@section('title', 'Pedido de notificação de produto')

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">Notificação de produto </h1>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Produto: {{ $notification->product->code }} -  {{ $notification->product->name }}</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Nome: {{ $notification->name }}</p>
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">E-mail:  {{ $notification->email }}</p>
      			</td>
    		</tr>
  		</tbody>
	</table>
@endsection
