@csrf

<x-adminlte-input name="title" label="Título:*" value="{{ $page->title ?? ''}}" placeholder="Insira título da página" enable-old-support/>
<x-adminlte-input name="permalink" label="Link:" placeholder="Insira o link da página" value="{{ $page ? $page->permalink : ''}}" enable-old-support />
@php
    $config = [
        'state' => (isset($page) && $page->status == 'S') || !isset($page) ? true : false,
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

@php
    $config = [
        'show' => (isset($page) && $page->show_in_menu) || !isset($page) ? true : false,
    ];    
@endphp
<x-adminlte-input-switch 
    name="show_in_menu"
    label="Mostrar no rodapé"
    data-on-color="success"
    data-off-color="danger"
    data-on-text="Sim"
    data-off-text="Não"
    :config="$config"
    checked="$config['show']"
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

<x-adminlte-input name="description" label="Descrição Abreviada:" value="{{ $page->description ?? ''}}" placeholder="Insira descrição para SEO" enable-old-support/>

<x-adminlte-text-editor name="content" label="Conteúdo:" 
    igroup-size="sm" placeholder="Conteúdo da página" :config="$config" enable-old-support>
    {{ $page->content ?? ''}}
</x-adminlte-text-editor>

@php
    $config = ['format' => 'DD/MM/YYYY'];
@endphp
<div class="row">
    <x-adminlte-input-date name="date_initial" :config="$config" placeholder="Escolha a data"
        label="Data Publicação:" class="col-md-6" value="{{ $page ? $page->date_initial : ''}}">
        <x-slot name="appendSlot">
            <x-adminlte-button icon="fas fa-lg fa-calendar"
                title="Selecione a data de publicação"/>
        </x-slot>
    </x-adminlte-input-date>

    <x-adminlte-input-date name="date_final" :config="$config" placeholder="Escolha a data"
        label="Data Finalização:" class="col-md-6"  value="{{ $page ? $page->date_final : ''}}">
        <x-slot name="appendSlot">
            <x-adminlte-button icon="fas fa-lg fa-calendar"
                title="Selecione a data de finalização"/>
        </x-slot>
    </x-adminlte-input-date>
</div>

<a href="{{ route('admin.pages.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>

