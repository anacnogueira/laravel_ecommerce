@csrf
<input id="city-id-selected" type="hidden" value="{{ $shipping->city_id ?? ''}}" />

<x-adminlte-input name="name" label="Nome:*" value="{{ $shipping->name ?? ''}}" enable-old-support/>

@php
    $config = [
        "height" => "100",
        "toolbar" => [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
    ]
@endphp
<x-adminlte-text-editor name="description" label="Descrição:"
    igroup-size="sm" :config="$config" enable-old-support>
     {{ $shipping->description ?? ''}}
</x-adminlte-text-editor>

@php
$config = ['format' => 'DD/MM/YYYY'];
@endphp
<div class="row">
    <x-adminlte-input-date name="date_begin" :config="$config" placeholder="Escolha a data"
        label="Data Publicação:" class="col-md-6" value="{{ $shipping ? $shipping->date_begin : ''}}" enable-old-support>
        <x-slot name="appendSlot">
            <x-adminlte-button icon="fas fa-lg fa-calendar"
                title="Selecione a data de publicação"/>
        </x-slot>
    </x-adminlte-input-date>

    <x-adminlte-input-date name="date_end" :config="$config" placeholder="Escolha a data"
        label="Data Finalização:" class="col-md-6"  value="{{ $shipping ? $shipping->date_end : ''}}" enable-old-support>
        <x-slot name="appendSlot">
            <x-adminlte-button icon="fas fa-lg fa-calendar"
                title="Selecione a data de finalização"/>
        </x-slot>
    </x-adminlte-input-date>
</div>

<p><strong>Regras</strong></p>
<div class="row">
    <div class="col-md-6">
        <x-adminlte-select name="state_id" id="state-id" label="Estado:" enable-old-support>
            @foreach($states as $state)
                <option value="{{ $state->id }}" {{ isset($shipping->state_id) && $state->id == $shipping->state_id ? "selected" : "" }}>{{ $state->name }}</option>
            @endforeach
        </x-adminlte-select>
    </div>
    <div class="col-md-6">
        <x-adminlte-select name="city_id" id="city-id" label="Cidade:" enable-old-support disabled>
             @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ isset($shipping->city_id) && $city->id == $shipping->city_id ? "selected" : "" }}>{{ $city->name }}</option>
            @endforeach
        </x-adminlte-select>
    </div>
</div>
 <x-adminlte-select name="product_id" label="Produto:" enable-old-support>
    @foreach($products as $product)
        <option value="{{ $product->id }}" {{ isset($shipping->product_id) && $product->id == $shipping->product_id ? "selected" : "" }}>{{ $product->name }}</option>
    @endforeach
</x-adminlte-select>

<div class="row">
    <div class="col-md-6">
        <x-adminlte-input name="total" label="Total do Pedido:" value="{{ $shipping->total ?? ''}}" class="money" placeholder="0,00" enable-old-support/>
    </div>
    <div class="col-md-6">
        <x-adminlte-input name="price" id="price" label="Valor:" value="{{ $shipping->price ?? ''}}" class="money" placeholder="0,00" enable-old-support>
            <x-slot name="bottomSlot">
                <input type="checkbox" id="free" /> <label for="free">Frete Grátis</label>
            </x-slot>
        </x-adminlte-input>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <x-adminlte-input name="delivery_time" type="number" label="Prazo de entrega:*" value="{{ $shipping->delivery_time ?? ''}}" enable-old-support>
           <x-slot name="bottomSlot">
             em dias
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($shipping) && $shipping->status == 'S') || !isset($shipping) ? true : false,
            ];
        @endphp
        <x-adminlte-input-switch
            name="status"
            label="Status:"
            data-on-color="success"
            data-off-color="danger"
            data-on-text="Ativo"
            data-off-text="Inativo"
            :config="$config"
            checked="$config['state']"
            enable-old-support />
    </div>
</div>

<a href="{{ route('admin.shippings.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>

