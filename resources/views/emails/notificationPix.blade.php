@extends('emails.layouts.default')

@section('title', 'Notificação de status de pagamento')

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">Notificação de status de pagamento </h1>
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Olá {{ $order->contact->name }},</p>
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Notificamos que seu pedido de número  {{ $order->id }} está com status de pagamento <strong>{{ $order->orderStatus->name }}</strong></p>
        
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Caso tenha alguma dúvida sobre seu pedido entre e contato através de um de nossos canais de atendimento:</p>
          			<p>E-mail:<a href="mailto:atendimento@mayacosmeticos.com.br">atendimento@mayacosmeticos.com.br</a></p>
          			<p>Contato: <a href="https://mayacosmeticos.com.br/contato" target="_blank">Clique Aqui</a></p>
          			<p>Whatsapp: <a href="https://api.whatsapp.com/send?1=pt_BR&phone=5512988681452" target="_blank">(12) 98868-1452</a></p>

        			<p><strong> Horário de atendimento:</strong> <br>
          				Segunda à Sexta das 09h às 19h<br>
          				Sábado das 9h às 16h
        			</p>
      			</td>
    		</tr>
    		@if ($order->orderStatus->value == "paid")    
    		<tr>
    			<td>
      				<br>
      				<h2 style="font-family: Arial;color: #cd5c6e; font-size: 18px;font-weight: 400;">Acompanhe seu pedido</h2>
      				<p>Se preferir, você pode acompanhar o pedido pelo site. </p>
      				<table width="229" border="0" align="center">
        				<tbody>
          					<tr>
            					<td align="center" style="background-color: #cd5c6e; padding: 10px">
              						<a href='{{ env("SITE_URL") }}/pedido/{{ $order->id }}' style='font-family: Arial; color: #ede6e6; font-size: 12px; font-weight: 400; text-decoration:none'>Acompanhe seu pedido</a>
            					</td>
          					</tr>
        				</tbody>
      				</table>
    			</td>
  			</tr>
  			@endif  
  		</tbody>
	</table>
@endsection