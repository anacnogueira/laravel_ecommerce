<div class="row">
    <div class="col-md-12">
        @csrf
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
        
        <x-adminlte-text-editor name="question" label="Pergunta:*" 
            igroup-size="sm" placeholder="Pergunta" :config="$config" enable-old-support>
            {{ $faq->question ?? ''}}
        </x-adminlte-text-editor>

        <x-adminlte-text-editor name="content" label="Resposta:*" 
            igroup-size="sm" placeholder="Resposta" :config="$config" enable-old-support>
            {{ $faq->answer ?? ''}}
        </x-adminlte-text-editor>        

        <x-adminlte-input name="order" type="number" label="Ordem:" value="{{ $faq->order ?? ''}}" placeholder="Insira a ordem da pergunta" enable-old-support/>
        
    
        @php
            $config = [
                'state' => (isset($faq) && $faq->status == 'S') || !isset($faq) ? true : false,
            ];
        @endphp    
        <x-adminlte-input-switch 
            name="status"
            label="Status:"
            data-on-color="success"
            data-off-color="danger"
             data-on-text="Ativo"
            data-off-text="Inativo"
            :config="$config"
            checked="$config['state']"
            enable-old-support />
       
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>       
    </div>
</div>