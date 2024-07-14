@csrf

<x-adminlte-input name="name" label="Name:*" value="{{ $banner->name }}" placeholder="Insira nome do banner"/>
<x-adminlte-input name="dimension" label="Tamanho:" placeholder="Insira o tamanho dobanner no formato alturaXlargura"/>
<x-adminlte-input name="url" label="Link:" placeholder="Insira o link do banner"/>
<x-adminlte-input-file name="upload" label="Imagem:" placeholder="Escolha um arquivo...">
    <x-slot name="prependSlot">
        <div class="input-group-text bg-lightblue">
            <i class="fas fa-upload"></i>
        </div>
    </x-slot>
</x-adminlte-input-file>
<p><strong>Instruções para inserção de imagem:</strong></p>
 <ul>
    <li>Extensões permitidas: gif,jpg e png</li>
    <li>Cada imagem não deve ultrapassar 5MB</li>
</ul>
<x-adminlte-textarea name="html" label="HTML:" cols="40" rows="10"/>

@php
$config = ['format' => 'DD/MM/YYYY'];
@endphp
<div class="row">
    <x-adminlte-input-date name="scheduled_date" :config="$config" placeholder="Escolha a data"
        label="Data Publicação:" class="col-md-6">
        <x-slot name="appendSlot">
            <x-adminlte-button icon="fas fa-lg fa-calendar"
                title="Selecione a data de publicação"/>
        </x-slot>
    </x-adminlte-input-date>

    <x-adminlte-input-date name="expire_date" :config="$config" placeholder="Escolha a data"
        label="Data Finalização:" class="col-md-6">
        <x-slot name="appendSlot">
            <x-adminlte-button icon="fas fa-lg fa-calendar"
                title="Selecione a data de finalização"/>
        </x-slot>
    </x-adminlte-input-date>
</div>

<x-adminlte-input type="number" name="expire_impressions" label="Impressões/visitas:" placeholder="Insira somente números"/>

<p><strong>Notas sobre o banner</strong></p>
 <ul>
    <li>Use uma imagem ou um texto HTML para o banner - não ambos.</li>
    <li>o Texto HTML tem prioridade sobre uma imagem </li>
</ul>
 <p><strong>Nota sobre a expiração:</strong></p>
<ul>
    <li>Apenas um dos dois campos deve ser preenchido</li>
     <li>Se o banner não expira automaticamente, deixe ambos em branco </li>
</ul>
<p><strong>Nota sobre a Programação:</strong></p>
<ul>
    <li> Se uma programação foi definida, o banner será ativado naquela data.</li>
    <li> Todos os baners programados são marcados como desativados até que aquela data tenha chegado, e então serão marcados como ativos.</li>
</ul>

<a href="{{ route('admin.banners.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>