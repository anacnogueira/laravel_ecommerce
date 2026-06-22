@csrf

<p>Cliente: {{ $customer->name }}</p>

<x-adminlte-input type="hidden" name="contact_id" value="{{ $customer->id }}" />

<x-adminlte-input name="title" label="Título:*" value="{{ $address ? $address->title : '' }}" enable-old-support />

<x-adminlte-input name="cep" label="CEP:*" value="{{ $address ? $address->cep : '' }}" class="cep-mask"
    placeholder="00000-000" enable-old-support>
    <x-slot name="bottomSlot">
        <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">Não sei o CEP</a>
    </x-slot>
</x-adminlte-input>

<x-adminlte-input name="address" label="Endereço:*" value="{{ $address ? $address->address : '' }}"
    enable-old-support />

<x-adminlte-input name="number" label="Número:*" value="{{ $address ? $address->number : '' }}" enable-old-support />

<x-adminlte-input name="complement" label="Complement:" value="{{ $address ? $address->complement : '' }}"
    enable-old-support />

<x-adminlte-input name="neighborhood" label="Bairro:" value="{{ $address ? $address->neighborhood : '' }}"
    enable-old-support />

<x-adminlte-select name="country_id" id="country-id" label="País:*" enable-old-support>
    @foreach ($countries as $country)
        <option value="{{ $country->id }}"
            {{ isset($address->country_id) && $country->id == $address->country_id ? 'selected' : '' }}>
            {{ trim($country->name) }}
        </option>
    @endforeach
</x-adminlte-select>

<x-adminlte-select name="state_id" id="state-id" label="Estado:*" enable-old-support>
    @foreach ($states as $state)
        <option value="{{ $state->id }}"
            {{ isset($address->state_id) && $state->id == $address->state_id ? 'selected' : '' }}>
            {{ trim($state->name) }}
        </option>
    @endforeach
</x-adminlte-select>

<x-adminlte-select name="city_id" id="city-id" label="Cidade:" enable-old-support disabled>
    @if ($cities)
        @foreach ($cities as $city)
            <option value="{{ $city->id }}"
                {{ isset($address->city_id) && $city->id == $address->city_id ? 'selected' : '' }}>
                {{ trim($city->name) }}
            </option>
        @endforeach
    @endif
</x-adminlte-select>

<x-adminlte-input name="phone" label="Telefone:" value="{{ $address ? $address->phone : '' }}" class="phone-mask"
    placeholder="(00) 00000-0000" enable-old-support />

<a href="{{ route('admin.addresses.index', $customer->id) }}" class="btn btn-warning"><i class="fa fa-times"></i>
    Cancelar</a>
<x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check" />

@push('js')
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript" src="{{ asset('js/admin/utils/jquery.selects.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/utils/get-cities.js') }}"></script>
    <script src="{{ asset('js/utils/get-address.js') }}" type="module"></script>
    <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/utils/add-update-contact-addresses.js') }}"></script>
@endpush
