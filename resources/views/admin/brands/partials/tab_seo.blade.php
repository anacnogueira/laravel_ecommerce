<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="permalink_old" label="Permalink Antigo:*" value="{{ $brand->permalink_old ?? ''}}" placeholder="Insira permalink antigo"/>
        <x-adminlte-input name="permalink" label="Permalink:*" value="{{ $brand->permalink ?? ''}}" placeholder="Insira permalink novo"/>
        <x-adminlte-input name="short_description" label="Descrição Abreviada:" value="{{ $brand->short_description ?? ''}}" placeholder="Insira descrição para SEO"/>
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
        <x-adminlte-text-editor name="text" label="Descrição completa:" 
            igroup-size="sm" placeholder="Descrição da marca" :config="$config"/>
 	</div>
</div> 	