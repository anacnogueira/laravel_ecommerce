<div class="row">
    <div class="col-md-12">
        <x-adminlte-input name="name" label="Nome:*" value="{{ $event->name ?? '' }}" enable-old-support />
        @php
            $config = [
                'height' => '200',
                'toolbar' => [
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
            ];
        @endphp
        <x-adminlte-text-editor name="description" label="Descrição:" igroup-size="sm" :config="$config"
            enable-old-support>
            {!! $event->description ?? '' !!}
        </x-adminlte-text-editor>

        <x-adminlte-textarea name="excerpt" label="Resumo:" cols="40" rows="10" enable-old-support>
            {{ $event ? $event->excerpt : '' }}
        </x-adminlte-textarea>

        <x-adminlte-input-file name="upload" label="Imagem:" placeholder="Escolha um arquivo..." legend="Procurar">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>
        <div id="imagePreview">
            @if (isset($event->image))
                <img src="{{ Storage::url($event->image) }}" alt="" style="width: 300px;">
            @endif
        </div>

        <div class="row">
            <div class="col-md-4">
                <x-adminlte-input type="number" name="vacancies" label="Vagas:*" value="{{ $event->vacancies ?? '' }}"
                    enable-old-support />
            </div>
            <div class="col-md-4">
                <x-adminlte-input name="value" label="Valor:" value="{{ $event->value ?? '' }}" class="money"
                    placeholder="0,00" enable-old-support />
            </div>
            <div class="col-md-4">
                @php
                    $config = [
                        'state' => (isset($event) && $event->status == 'S') || !isset($event) ? true : false,
                    ];
                @endphp
                <x-adminlte-input-switch name="status" label="status" data-on-color="success" data-off-color="danger"
                    data-on-text="Ativo" data-off-text="Inativo" :config="$config" checked="$config['state']"
                    enable-old-support />
            </div>
        </div>
    </div>
</div>
