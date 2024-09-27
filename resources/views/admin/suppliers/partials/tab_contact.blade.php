<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="phone" label="Telefone:" value="{{ $supplier->phone ?? ''}}" placeholder="(00)0000-0000" class="phone" enable-old-support/>

        <x-adminlte-input name="mobile" label="Celular:" value="{{ $supplier->mobile ?? ''}}" placeholder="(00)00000-0000" class="mobile" enable-old-support/>

        <x-adminlte-input name="email" type="email" label="E-mail:" value="{{ $supplier->email ?? ''}}" placeholder="Insira o e-mail" enable-old-support/>

        <x-adminlte-input name="website" type="url" label="Website:" value="{{ $supplier->website ?? ''}}" placeholder="Insira o website" enable-old-support/>
    </div>
</div>    