@csrf

<x-adminlte-input name="title" label="Título:*" value="{{ $page->title ?? ''}}" placeholder="Insira título da página" enable-old-support/>
<x-adminlte-input name="permalink" label="Link:" placeholder="Insira o link da página" value="{{ $page ? $page->permalink : ''}}" enable-old-support />
@php
    $config = [
        'state' => (isset($banner) && $banner->status == 'S') || !isset($banner) ? true : false,
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
    checked="$config['state']"
    enable-old-support />

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
<x-adminlte-text-editor name="content" label="Conteúdo:" 
    igroup-size="sm" placeholder="Conteúdo da página" :config="$config" enable-old-support/>
<a href="{{ route('admin.pages.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>