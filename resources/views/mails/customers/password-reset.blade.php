@extends('mails.layouts.default')

@section('title', "Recuperação de Senha - Maya Cosméticos")

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">Olá, {{ $contactName }} </h1>
                    <p>Você está recebendo este e-mail porque solicitou a redefinição de senha da sua conta.</p>
                    <div align="center" style="background-color: #921130; padding: 10px; width: 150px; margin: 0 auto;">
                        <a href="{{ $url }}" style="font-family: Arial; color: #ede6e6; font-size: 12px; font-weight: 400; text-decoration:none">Resetar Senha</a>
                    </div>
                    <p>Este link de expira em 60 minutos.</p>
                    <p>Se você não solicitou isso, ignore este e-mail.</p>
                    <br/>
                    <p>Atenciosamente,</p>
      			</td>
    		</tr>
  		</tbody>
	</table>
@endsection
