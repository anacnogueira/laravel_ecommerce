<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="name" label="Nome:*" value="{{ $brand->name ?? ''}}" placeholder="Insira nome da marca"/>
        @php
            $config = [
                'state' => (isset($brand) && $brand->status == 'S') || !isset($brand) ? true : false,
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
            checked="$config['state']" />
        
        <x-adminlte-input-file name="upload" label="Imagem:" placeholder="Escolha um arquivo..." legend="Procurar">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>
        <div id="imagePreview">
            @if(isset($brand->image))
                <img src="{{ Storage::url($brand->image) }}" alt="" style="width: 300px;">
            @endif
        </div>
        
 	</div>
</div> 	