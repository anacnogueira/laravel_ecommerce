@extends('mails.layouts.default')

@section('title', "Cliente cadastrado através do $method")

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">Parabéns, cadastro realizado com sucesso </h1>
                    @if ($method == 'admin')
                        <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                            Acesse a página <a href='{{ env('SITE_URL') }}/esqueci-minha-senha'>Esqueci minha senha</a>,
                            insira o e-mail cadastrado, {{ $email }}, para receber o link para cadastrar sua senha.
                        </p>
                    @else
                        <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                            Guarde suas credenciais fornecidas para acesso (e-mail e senha) para acessar sua conta.
                        </p>
                        <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                            Caso não se lembre da senha criada, acesse a página <a href='{{ env('SITE_URL') }}/esqueci-minha-senha'>Esqueci minha senha</a>
                            para fornecer uma nova senha.
                        </p>
                    @endif

      			</td>
    		</tr>
  		</tbody>
	</table>
@endsection
