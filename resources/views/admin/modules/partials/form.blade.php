<div class="row">
    <div class="col-md-12">
        @csrf
        <x-adminlte-select name="parent_id" label="Pai:">
        @foreach($modules as $mod)
                <option value="{{ $mod->id }}" {{ isset($module->parent_id) && $mod->id == $module->parent_id ? "selected" : "" }}>{{ $mod->name }}</option>
        @endforeach
        </x-adminlte-select>

        <x-adminlte-input name="name" label="Nome:*" value="{{ $module->name ?? ''}}" placeholder="Insira nome do módulo" enable-old-support/>

        <x-adminlte-input name="icon" label="Ícone:" value="{{ $module->icon ?? ''}}" placeholder="Insira icone do módulo" enable-old-support/>

        <x-adminlte-input name="slug" label="Apelido:" value="{{ $module->slug ?? ''}}" placeholder="Insira apelido do módulo" enable-old-support/>

        <x-adminlte-input type="number" name="order" label="Ordem:*" value="{{ $module->order ?? ''}}" placeholder="Insira a ordem do módulo" enable-old-support/>

        @php
            $config = [
                'state' => (isset($module) && $module->status == 'S') || !isset($module) ? true : false,
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

        <a href="{{ route('admin.modules.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>    
    </div>
</div>       