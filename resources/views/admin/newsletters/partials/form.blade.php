@csrf

<x-adminlte-select name="contact_id" label="Cliente:" enable-old-support>
    @foreach($customers as $customer)
        <option value="{{ $customer->id }}" {{ isset($newsletter->contact_id) && $customer->id == $newsletter->contact_id ? "selected" : "" }}>{{ $customer->name }}</option>
    @endforeach
</x-adminlte-select>

<x-adminlte-input name="email" label="E-mail:*" type="email" value="{{ $newsletter ? $newsletter->email : '' }}" enable-old-support/>

<a href="{{ route('admin.newsletters.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
