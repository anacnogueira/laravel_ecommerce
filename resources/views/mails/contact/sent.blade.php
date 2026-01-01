@extends('mails.layouts.default')

@section('title', 'Contato via formulário')

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">{{ $data["subject"] }}</h1>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Nome: {{ $data['name'] }}</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Telefone: {{ $data["telephone"] }}</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">E-mail: {{ $data["email"] }}</p>
        			<div style="font-family: Arial; color: #000000; font-size: 12px;">{{ $data["message"] }}</div>
      			</td>
    		</tr>
  		</tbody>
	</table>
@endsection
