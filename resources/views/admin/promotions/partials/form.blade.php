@csrf
<input id="city-id-selected" type="hidden" value="{{ $shipping->city_id ?? ''}}" />

 <x-adminlte-select name="product_id" id="product-id" label="Produto:" enable-old-support>
    @foreach($products as $product)
        <option value="{{ $product->id }}" {{ isset($promotion->product_id) && $product->id == $promotion->product_id ? "selected" : "" }}>{{ $product->name }}</option>
    @endforeach
</x-adminlte-select>

<x-adminlte-input name="selling_price" id="selling-price" label="Preço Original:" value="{{ $promotion->product->selling_price ?? '' }}" class="money" placeholder="0,00" disabled/>

<div class="row">
    <div class="col-md-6">
        <x-adminlte-input name="percent_promotion" id="percent-promotion" label="Porcentagem:" value="{{ $promotion->percent_promotion ?? ''}}" class="money" placeholder="0,00" enable-old-support/>
    </div>
    <div class="col-md-6">
         <x-adminlte-input name="price_promotion" id="price-promotion" label="Preço Promocional:" value="{{ $promotion->price_promotion ?? ''}}" class="money" placeholder="0,00" enable-old-support/>
    </div>
</div>

@php
 $config = ['format' => 'DD/MM/YYYY'];
@endphp
<div class="row">
    <div class="col-md-6">
        <x-adminlte-input-date name="date_initial" :config="$config" placeholder="Escolha a data"
            label="Início:" class="col-md-6" value="{{ $promotion ? date('d/m/Y', strtotime($promotion->date_initial)) : ''}}" enable-old-support>
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-lg fa-calendar"
                    title="Selecione a data de publicação"/>
            </x-slot>
        </x-adminlte-input-date>
    </div>
    <div class="col-md-6">
        <x-adminlte-input-date name="date_final" :config="$config" placeholder="Escolha a data"
            label="Data Finalização:" class="col-md-6"  value="{{ $promotion ? date('d/m/Y', strtotime($promotion->date_final)) : ''}}" enable-old-support>
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-lg fa-calendar"
                    title="Selecione a data de finalização"/>
            </x-slot>
        </x-adminlte-input-date>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($promotion) && $promotion->status == 'S') || !isset($promotion) ? true : false,
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
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($promotion) && $promotion->black_friday == 'S') ? true : false,
            ];
        @endphp
        <x-adminlte-input-switch
            name="black_friday"
            label="Black Friday:"
            data-on-color="success"
            data-off-color="danger"
            data-on-text="Sim"
            data-off-text="Não"
            :config="$config"
            checked="$config['state']"
            enable-old-support />
    </div>
</div>



<a href="{{ route('admin.shippings.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>

