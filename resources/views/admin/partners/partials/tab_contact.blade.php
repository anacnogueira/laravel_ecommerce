<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="phone" label="Telefone:" value="{{ $partner->phone ?? ''}}" placeholder="(00)0000-0000" class="phone" enable-old-support/>

        <x-adminlte-input name="mobile" label="Celular:" value="{{ $partner->mobile ?? ''}}" placeholder="(00)00000-0000" class="phone" enable-old-support/>

        <x-adminlte-input name="email" type="email" label="E-mail:*" value="{{ $partner->email ?? ''}}" placeholder="Insira o e-mail" enable-old-support/>

        <x-adminlte-input name="Website" type="url" label="Website:" value="{{ $partner->website ?? ''}}" placeholder="Insira o website" enable-old-support/>
    </div>
</div>
