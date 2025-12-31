<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="code" label="Código:*" value="{{ $product->code ?? ''}}" enable-old-support/>
        <x-adminlte-input name="cost_price" label="Custo:" class="money" value="{{ $product->cost_price ?? ''}}" enable-old-support/>
        <x-adminlte-select name="contact_id" label="Fornecedor:*" enable-old-support>
            @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ isset($product->contact_id) && $supplier->id == $product->contact_id ? "selected" : "" }}>{{ $supplier->fantasy_name }}</option>
            @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="brand_id" label="Marca:*" enable-old-support>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ isset($product->brand_id) && $brand->id == $product->brand_id ? "selected" : "" }}>{{ $brand->name }}</option>
            @endforeach
        </x-adminlte-select>
        <x-adminlte-select name="origin" label="Origem:*">
            @foreach($origins as $key => $origin)
                <option value="{{ $key }}" {{ isset($product->origin) && $key == $product->origin ? "selected" : "" }}>{{ $origin }}</option>
            @endforeach
        </x-adminlte-select>

    </div>
</div>

