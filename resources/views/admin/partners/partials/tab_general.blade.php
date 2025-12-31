<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="name" label="Razão Social:*" value="{{ $partner->name ?? ''}}" placeholder="Insira a razão Social do Fornecedor" enable-old-support/>

        <x-adminlte-input name="fantasy_name" label="Nome fantasia:*" value="{{ $partner->fantasy_name ?? ''}}" placeholder="Insira nome fantasia do Fornecedor" enable-old-support/>

        <x-adminlte-input name="cnpj" label="CNPJ:*" value="{{ $partner->cnpj ?? ''}}" placeholder="00.000.000/00000-00" class="cnpj" enable-old-support/>

        <x-adminlte-input name="ie" label="Inscrição Estadual:" value="{{ $partner->ie ?? ''}}" placeholder="Insira a inscrição estadual" enable-old-support/>

        <x-adminlte-input name="im" label="Inscrição Municipal:" value="{{ $partner->im ?? ''}}" placeholder="Insira a inscrição municipal" enable-old-support/>

        <x-adminlte-input-file name="upload" label="Imagem:" placeholder="Escolha um arquivo..." legend="Procurar">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>
        <div id="imagePreview">
            @if(isset($partner->image))
                <img src="{{ Storage::url($partner->image) }}" alt="" style="width: 300px;">
            @endif
        </div>

        <x-adminlte-textarea name="description" label="Descrição:" cols="40" rows="10" enable-old-support>
            {{ $partner ? $partner->description : ''}}
        </x-adminlte-textarea>

    </div>
</div>
