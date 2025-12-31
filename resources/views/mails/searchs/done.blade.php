@extends('mails.layouts.default')

@section('title', "Nova pesquisa de $type feita no site")

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">Nova busca no site </h1>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Tipo: {{ $type }}</p>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Valor: {{ $search->keyword }}</p>
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Data:  {{ $search->created }}</p>
      			</td>
    		</tr>
  		</tbody>
	</table>
@endsection
