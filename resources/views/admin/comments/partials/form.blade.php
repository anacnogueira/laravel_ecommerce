@csrf


<x-adminlte-select name="product_id" label="Produto:*" enable-old-support>
    @foreach($products as $product)
        <option value="{{ $product->id }}" {{ isset($comment->product_id) && $product->id == $comment->product_id ? "selected" : "" }}>{{ $product->name }}</option>
    @endforeach
</x-adminlte-select>

<x-adminlte-input name="name" label="Name:*" value="{{ $comment->name ?? ''}}" enable-old-support/>

<x-adminlte-input name="email" label="E-mail:*" type="email" value="{{ $comment->email ?? ''}}" enable-old-support/>

 <x-adminlte-input-slider name="rate" label="Nota:*" min=0 max=5 step=1 color="#3c8dbc" value="{{ $comment->rate ?? 0 }}" enable-old-support/>

<x-adminlte-textarea name="text" label="Comentário:*" cols="40" rows="10" enable-old-support>
    {{ $comment ? $comment->text : ''}}
</x-adminlte-textarea>

@php
    $config = [
        'state' => (isset($comment) && $comment->status == 'S') || !isset($comment) ? true : false,
    ];

@endphp
<x-adminlte-input-switch
    name="status"
    label="status"
    data-on-color="success"
    data-off-color="danger"
    data-on-text="Ativo"
    data-off-text="Inativo"
    :config="$config"
    checked="$config['state']"
    enable-old-support />

<a href="{{ route('admin.comments.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
