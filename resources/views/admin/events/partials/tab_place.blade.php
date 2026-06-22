<div class="row">
    <div class="col-md-12">
        <div class="row">
            <x-adminlte-input name="cep" label="CEP:" value="{{ $event->cep ?? '' }}" placeholder="00000-000"
                class="custom cep" fgroup-class="col-md-2" enable-old-support>
                <x-slot name="bottomSlot">
                    <span> <a href='http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCep.cfm'
                            target='_blank'>Não sei o CEP</a></span>
                </x-slot>
            </x-adminlte-input>
        </div>
        <div class="row">
            <x-adminlte-input name="address" id="address" label="Endereço:" value="{{ $event->address ?? '' }}"
                fgroup-class="col-md-10" enable-old-support />

            <x-adminlte-input name="number" label="Nùmero:" value="{{ $event->number ?? '' }}" fgroup-class="col-md-2"
                enable-old-support />
        </div>
        <div class="row">
            <x-adminlte-input name="complement" label="Complemento:" value="{{ $event->complement ?? '' }}"
                fgroup-class="col-md-6" enable-old-support />

            <x-adminlte-input name="neighborhood" id="neighborhood" label="Bairro:"
                value="{{ $event->neighborhood ?? '' }}" fgroup-class="col-md-6" enable-old-support />
        </div>
        <div class="row">
            <x-adminlte-select name="country_id" id="country-id" label="País:" fgroup-class="col-md-4"
                enable-old-support>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{ isset($event->country_id) && $country->id == $event->country_id ? 'selected' : '' }}>
                        {{ $country->name }}</option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-select name="state_id" id="state-id" label="Estado:" fgroup-class="col-md-4"
                enable-old-support>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}"
                        {{ isset($event->state_id) && $state->id == $event->state_id ? 'selected' : '' }}>
                        {{ $state->name }}</option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-select name="city_id" id="city-id" label="Cidade:" fgroup-class="col-md-4" enable-old-support>
                @if ($cities)
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ isset($event->city_id) && $city->id == $event->city_id ? 'selected' : '' }}>
                            {{ $city->name }}</option>
                    @endforeach
                @endif

            </x-adminlte-select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($event) && $event->show_map == 'S') || !isset($event) ? true : false,
            ];
        @endphp
        <x-adminlte-input-switch name="show_map" label="Mostrar mapa:*" data-on-color="success" data-off-color="danger"
            data-on-text="Sim" data-off-text="Não" :config="$config" checked="$config['show_map']" enable-old-support />
    </div>
    <div class="col-md-6">
        @php
            $config = [
                'state' => (isset($event) && $event->show_link_map == 'S') || !isset($event) ? true : false,
            ];
        @endphp
        <x-adminlte-input-switch name="show_link_map" label="Mostrar link do mapa:*" data-on-color="success"
            data-off-color="danger" data-on-text="Sim" data-off-text="Não" :config="$config"
            checked="$config['show_link_map']" enable-old-support />
    </div>
</div>
