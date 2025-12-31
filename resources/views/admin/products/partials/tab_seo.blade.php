<div class="row">
    <div class="col-md-12">
        <x-adminlte-input name="meta_title" label="Título da página:" value="{{ $product->meta_title ?? ''}}" enable-old-support>
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class='fa fa-question-circle' aria-hidden='true' data-toggle='tooltip' data-placement='right' title='Título público para a página do produto e para os mecanismos de busca. Deixe em branco para usar o nome do produto. Recomendado o uso de 70 caracteres.'></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input name="permalink_old" label="Permalink Antigo:" value="{{ $product->permalink_old ?? ''}}" enable-old-support>
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class='fa fa-question-circle' aria-hidden='true' data-toggle='tooltip' data-placement='right' title='Utilizados para gerar link amigável para humanos. Utilizado APENAS para retrocompatibilidade com versão antiga. Adicione :name para gerar automaticamente a partir do nome do produto'></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input name="permalink" label="Permalink:" value="{{ $product->permalink ?? ''}}" enable-old-support>
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class='fa fa-question-circle' aria-hidden='true' data-toggle='tooltip' data-placement='right' title='Utilizados para gerar link amigável para humanos. Adicione :name para gerar automaticamente a partir do nome do produto'></i>
                </div>
            </x-slot>
        </x-adminlte-input>

        <x-adminlte-input name="description" label="Descrição Abreviada:" value="{{ $product->description ?? ''}}" enable-old-support>
            <x-slot name="prependSlot">
                <div class="input-group-text">
                    <i class='fa fa-question-circle' aria-hidden='true' data-toggle='tooltip' data-placement='right' title='Esta descrição aparecerá nos motores de busca. Você precisa de uma única frase, com menos de 160 caracteres (incluindo espaços)'></i>
                </div>
            </x-slot>
        </x-adminlte-input>

    </div>
</div>
