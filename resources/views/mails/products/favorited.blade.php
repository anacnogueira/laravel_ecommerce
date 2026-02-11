@extends('mails.layouts.default')

@section('title', "Novo Produto Favoritado no site")

@section('content')
	<table width="520" border="0">
  		<tbody>
    		<tr>
      			<td>
        			<h1 style="font-family: Arial; color: #a61922; font-size: 18px; font-weight: 400;">Novo Produto Favoritado no site </h1>
                    <p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                        <strong>Produto:</strong> {{ $productContact->product->code }} - {{ $productContact->product->name }}
                    </p>
        			<p style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                        <strong>Cliente: </strong> {{ $productContact->contact->id }} - {{ $productContact->contact->name }}
                    </p>
      			</td>
    		</tr>
  		</tbody>
	</table>
@endsection
