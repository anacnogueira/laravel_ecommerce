@csrf

<x-adminlte-select name="state_id" label="Estado:" enable-old-support>
    @foreach($states as $state)
        <option value="{{ $state->id }}" {{ isset($city->state_id) && $state->id == $city->state_id ? "selected" : "" }}>{{ $state->name }}</option>
    @endforeach
</x-adminlte-select>
<x-adminlte-input name="name" label="Nome:*" placeholder="Insira o nome da cidade" value="{{ $city ? $city->name : ''}}" enable-old-support/>

<a href="{{ route('admin.cities.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>