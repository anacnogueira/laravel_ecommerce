@csrf

<x-adminlte-input name="name" label="Nome:*" value="{{ $user->name ?? ''}}" placeholder="Insira nome do usuário" enable-old-support/>

<x-adminlte-input name="telephone" class="phone" label="Telefone:" value="{{ $user->telephone ?? ''}}" placeholder="(99)9999-9999" enable-old-support/>

<x-adminlte-input name="cellular" class="phone" label="Celular:" value="{{ $user->cellular ?? ''}}" placeholder="(99)99999-9999" enable-old-support/>

<x-adminlte-input name="email" type="email" label="E-mail:*" value="{{ $user->email ?? ''}}" placeholder="Insira e-mail do usuário" enable-old-support/>

<p class="text-muted">Deixe em branco se não quiser alterar a senha.</p>
<x-adminlte-input name="password" type="password" label="Senha:"  placeholder="Insira a senha do  usuário">
    <x-slot name="bottomSlot">
        <p>A senha deve conter entre 6 e 15 caracteres</p>
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="password_confirmation" type="password" label="Redigite a senha:"  />


<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
