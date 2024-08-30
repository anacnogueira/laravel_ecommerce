<div class="row">
    <div class="col-md-12">
        <x-adminlte-input name="professional_name" label="Nome:*" value="{{ $event->professional_name ?? ''}}" placeholder="Insira nome do profissional" enable-old-support/>

        @php
            $config = [
                "height" => "100",
                "toolbar" => [
                    // [groupName, [list of button]]
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
        <x-adminlte-text-editor name="professional_curriculum" label="Mini Currículo:" 
            igroup-size="sm" placeholder="Descrição do profissional" :config="$config" enable-old-support>
            {{ $event->professional_curriculum ?? ''}}
        </x-adminlte-text-editor>

        <x-adminlte-input-file name="professional_photo" label="Foto:" placeholder="Escolha um arquivo..." legend="Procurar">
            <x-slot name="prependSlot">
                <div class="input-group-text bg-lightblue">
                    <i class="fas fa-upload"></i>
                </div>
            </x-slot>
        </x-adminlte-input-file>
        <div id="imagePreview">
            @if(isset($event->professional_photo))
                <img src="{{ Storage::url($event->professional_photo) }}" alt="" style="width: 300px;">
            @endif
        </div>
    </div>
</div>