@csrf

<x-adminlte-input name="name" label="Nome:*" value="{{ $coupon->name ?? ''}}" enable-old-support/>

@php
    $config = [
        "height" => "200",
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
     {{ $coupon->description ?? ''}}
</x-adminlte-text-editor>

<x-adminlte-input name="code" id="coupon-code" label="Código:*" value="{{ $coupon->code ?? ''}}" enable-old-support>
    <x-slot name="bottomSlot">
        <x-adminlte-button id="btn-generate-code" label="Gerar Código" theme="success"/>
    </x-slot>
</x-adminlte-input>

 <x-adminlte-select name="discount_type" label="Tipo:*" enable-old-support>
    @foreach($types as $key => $type)
        <option value="{{ $key }}" {{ isset($coupon->discount_type) && $key == $coupon->discount_type ? "selected" : "" }}>{{ $type }}</option>
    @endforeach
</x-adminlte-select>


<div class="row">
    <div class="col-md-6">
        <x-adminlte-input name="discount_amount" label="Desconto:*" value="{{ $coupon->discount_amount ?? ''}}" class="money" placeholder="0,00" enable-old-support/>
    </div>
    <div class="col-md-6">
         <x-adminlte-input name="total_amount" label="Valor mínimo:" value="{{ $coupon->total_amount ?? ''}}" class="money" placeholder="0,00" enable-old-support/>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($coupon) && $coupon->customer_login == 'S') ? true : false,
            ];
        @endphp
        <x-adminlte-input-switch
            name="customer_login"
            label="Usuário logado:"
            data-on-color="success"
            data-off-color="danger"
            data-on-text="Sim"
            data-off-text="Não"
            :config="$config"
            checked="$config['state']"
            enable-old-support />
    </div>
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($coupon) && $coupon->free_shipping == 'S') ? true : false,
            ];
        @endphp
        <x-adminlte-input-switch
            name="free_shipping"
            label="Frete Grátis:"
            data-on-color="success"
            data-off-color="danger"
            data-on-text="Sim"
            data-off-text="Não"
            :config="$config"
            checked="$config['state']"
            enable-old-support />
    </div>
</div>

@php
$config = ['format' => 'DD/MM/YYYY'];
@endphp
<div class="row">
    <div class="col-md-6">
        <x-adminlte-input-date name="from_date" :config="$config" placeholder="Escolha a data"
            label="Início:" class="col-md-6" value="{{ $coupon ? $coupon->from_date : ''}}" enable-old-support>
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-lg fa-calendar"
                    title="Selecione a data inicial"/>
            </x-slot>
        </x-adminlte-input-date>
    </div>
    <div class="col-md-6">
        <x-adminlte-input-date name="to_date" :config="$config" placeholder="Escolha a data"
            label="Data Finalização:" class="col-md-6"  value="{{ $coupon ? $coupon->to_date : ''}}" enable-old-support>
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-lg fa-calendar"
                    title="Selecione a data final"/>
            </x-slot>
        </x-adminlte-input-date>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <x-adminlte-input
            name="uses_per_coupon"
            type="number"
            min="1"
            label="Uso por cupom:"
            value="{{ $coupon->uses_per_coupon ?? ''}}"
            enable-old-support/>
    </div>
    <div class="col-md-6">
        <x-adminlte-input
            name="uses_per_customer"
            type="number"
            min="1"
            label="Uso por cliente:"
            value="{{ $coupon->uses_per_customer ?? ''}}"
            enable-old-support/>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($coupon) && $coupon->status == 'S') || !isset($coupon) ? true : false,
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

    </div>
</div>

<a href="{{ route('admin.coupons.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>

