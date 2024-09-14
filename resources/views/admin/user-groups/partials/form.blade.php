<div class="row">
    <div class="col-md-12">
        @csrf

        <x-adminlte-input name="name" label="Nome:*" value="{{ $userGroup->name ?? ''}}" placeholder="Insira nome do grup" enable-old-support/>
     
        @php
            $config = [
                'state' => (isset($userGroup) && $userGroup->status == 'S') || !isset($userGroup) ? true : false,
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

        <a href="{{ route('admin.user-groups.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
        <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
        
    </div>
</div>