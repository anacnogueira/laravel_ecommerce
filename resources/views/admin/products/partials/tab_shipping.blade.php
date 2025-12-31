<div class="row">
    <div class="col-md-3">
        <x-adminlte-input
            name="length"
            label="Comprimento"
            type="number"
            enable-old-support
            value="{{ $product->length ?? '' }}" >
            <x-slot name="appendSlot">
                <div class="input-group-text bg-dark">
                    cm
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-3">
        <x-adminlte-input
            name="width"
            label="Largura"
            type="number"
            enable-old-support
            value="{{ $product->width ?? '' }}">
            <x-slot name="appendSlot">
                <div class="input-group-text bg-dark">
                    cm
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-3">
        <x-adminlte-input
            name="height"
            label="Altura"
            type="number"
            enable-old-support
            value="{{ $product->height ?? '' }}">
            <x-slot name="appendSlot">
                <div class="input-group-text bg-dark">
                    cm
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
    <div class="col-md-3">
        <x-adminlte-input
            name="gross_weight"
            label="Peso"
            class="float"
            enable-old-support
            value="{{ $product->gross_weight ??  '' }}">
            <x-slot name="appendSlot">
                <div class="input-group-text bg-dark">
                    kg
                </div>
            </x-slot>
        </x-adminlte-input>
    </div>
</div>
