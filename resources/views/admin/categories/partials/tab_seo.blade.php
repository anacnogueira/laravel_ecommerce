<div class="row">
    <div class="col-md-12">
        <x-adminlte-input name="permalink_old" label="Permalink Antigo:*" value="{{ $category->permalink_old ?? '' }}"
            enable-old-support />
        <x-adminlte-input name="permalink" label="Permalink:*" value="{{ $category->permalink ?? '' }}"
            enable-old-support />
        <x-adminlte-input name="short_description" label="Descrição Abreviada:"
            value="{{ $category->short_description ?? '' }}" enable-old-support />
        @php
            $config = [
                'height' => '100',
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
        <x-adminlte-text-editor name="text" label="Descrição completa:" igroup-size="sm" :config="$config"
            enable-old-support>
            {!! $category->text ?? '' !!}
        </x-adminlte-text-editor>
    </div>
</div>
