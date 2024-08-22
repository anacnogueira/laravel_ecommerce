@csrf

<x-adminlte-select name="country_id" label="Páis:" enable-old-support>
    @foreach($countries as $country)
        <option value="{{ $country->id }}" {{ isset($state->country_id) && $country->id == $state->country_id ? "selected" : "" }}>{{ $country->name }}</option>
    @endforeach
</x-adminlte-select>
<x-adminlte-input name="name" label="Nome:*" placeholder="Insira o nome do estado" value="{{ $state ? $state->name : ''}}" enable-old-support/>
<x-adminlte-input name="uf" label="UF:" placeholder="Insira a sigla do estado" value="{{ $state ? $state->uf : ''}}" enable-old-support/>

<a href="{{ route('admin.states.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>