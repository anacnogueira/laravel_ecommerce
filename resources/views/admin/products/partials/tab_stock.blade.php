<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="status">Status:*</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="status1" name="status" value="S" {{ old('status') == 'S' || (isset($product->status) && $product->status == 'S') ? 'checked' : '' }}>
                <label for="status1" class="custom-control-label">Em estoque</label>
            </div>

            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="status2" name="status" value="N" {{ old('status') == 'N' || (isset($product->status) && $product->status == 'N') ? 'checked' : '' }}>
                <label for="status2" class="custom-control-label">Fora de estoque</label>
            </div>
            @error('status')
                <span class="invalid-feedback" style="display: block;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="column" label="Coluna:" value="{{ $product->column ?? ''}}" enable-old-support/>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="row" label="Fileira:" value="{{ $product->row ?? ''}}" enable-old-support/>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <x-adminlte-input name="current_stock" type="number" label="Estoque Atual:" value="{{ $product->current_stock ?? ''}}" enable-old-support/>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="maximum_stock" type="number" label="Estoque Máximo:" value="{{ $product->maximum_stock ?? ''}}" enable-old-support/>
    </div>
    <div class="col-md-4">
        <x-adminlte-input name="minimum_stock" type="number" label="Estoque Minímo:" value="{{ $product->minimum_stock ?? ''}}" enable-old-support/>
    </div>
</div>
