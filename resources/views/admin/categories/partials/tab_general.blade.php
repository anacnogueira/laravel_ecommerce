
<div class="row">
 	<div class="col-md-12">
        <x-adminlte-select name="parent_id" label="Pai:">
        @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        </x-adminlte-select>
        <x-adminlte-input name="name" label="Nome:*" value="{{ $category->name ?? ''}}" placeholder="Insira nome da categoria"/>
        @php
            $config = [
                'state' => (isset($category) && $category->status == 'S') || !isset($category) ? true : false,
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





 
       
        
        