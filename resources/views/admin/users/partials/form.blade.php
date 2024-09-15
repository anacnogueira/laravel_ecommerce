@csrf

<x-adminlte-input name="name" label="Nome:*" value="{{ $user->name ?? ''}}" placeholder="Insira nome do usuário" enable-old-support/>

<x-adminlte-input name="telephone" label="Telefone:" value="{{ $user->telefone ?? ''}}" placeholder="(99)9999-9999" enable-old-support/>

<x-adminlte-input name="celullar" label="Celular:" value="{{ $user->celullar ?? ''}}" placeholder="(99)99999-9999" enable-old-support/>

<x-adminlte-input name="email" type="email" label="E-mail:*" value="{{ $user->email ?? ''}}" placeholder="Insira e-mail do usuário" enable-old-support/>

<x-adminlte-input name="password" type="password" label="Senha:*"  placeholder="Insira a senha do  usuário">
    <x-slot name="bottomSlot">
        <p>A senha deve conter entre 6 e 15 caracteres</p>
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="password_confirmation" type="password" label="Redigite a senha:*"  />
        
@php
    $config = [
        'state' => (isset($user) && $user->status == 'S') || !isset($user) ? true : false,
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

<x-adminlte-select name="user_group_id" label="Grupo:*" enable-old-support>
    @foreach($userGroups as $userGroup)
        <option value="{{ $userGroup->id }}" {{ isset($user->user_group_id) && $userGroup->id == $user->user_group_id ? "selected" : "" }}>{{ $userGroup->name }}</option>
    @endforeach
</x-adminlte-select>


<a href="{{ route('admin.users.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>