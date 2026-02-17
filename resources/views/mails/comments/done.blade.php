@extends('mails.layouts.default')

@section('title', "Novo comentário para aprovação")

@section('content')
	<table width="520" border="0">
  		<tbody>
    	<tr>
            <td width="98" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">ID:</td>
            <td width="412" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
               {{ $comment->id }}
            </td>
        </tr>
        <tr>
            <td width="98" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Produto:</td>
            <td width="412" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                {{ $comment->product->name }}
            </td>
        </tr>
        <tr>
            <td width="98" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Nota:</td>
            <td width="412" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                {{ $comment->rate }}
            </td>
        </tr>
        <tr>
            <td width="98" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Nome </td>
            <td width="412" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                @if ($comment->contact_id)
                   {{  $comment->contact->name }}
                @else
                    {{ $comment->name }}
                @endif
            </td>
        </tr>
        <tr>
            <td width="98" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Email:</td>
            <td width="412" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                @if ($comment->contact_id)
                    {{  $comment->contact->email }}
                @else
                    {{ $comment->email }}
                @endif
            </td>
        </tr>
        <tr>
            <td width="98" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">Comentário:</td>
            <td width="412" style="font-family: Arial; color: #000000; font-size: 12px; font-weight: 400;">
                {{ $comment->text }}
            </td>
        </tr>
  		</tbody>
	</table>
    <p><a href="{{ route('admin.comments.edit', $comment->id) }}">Editar Comentário</a></p>

@endsection
