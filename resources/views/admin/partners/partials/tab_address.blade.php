<div class="row">
 	<div class="col-md-12">
        <x-adminlte-input name="cep" label="CEP:" value="{{ $partner->address[0]->cep ?? ''}}" placeholder="00000-000" class="custom cep" fgroup-class="col-md-2" enable-old-support>
            <x-slot name="bottomSlot">
                <span> <a href='http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCep.cfm' target='_blank'>Não sei o CEP</a></span>
            </x-slot>
        </x-adminlte-input>
        <div class="row">
            <x-adminlte-input name="address" id="address" label="Endereço:" value="{{ $partner->address[0]->address ?? ''}}" placeholder="Informe o endereço" fgroup-class="col-md-10" enable-old-support/>

            <x-adminlte-input name="number" label="Nùmero:" value="{{ $partner->address[0]->number ?? ''}}" placeholder="Informe o número" fgroup-class="col-md-2" enable-old-support/>
        </div>
        <div class="row">
             <x-adminlte-input name="complement" label="Complemento:" value="{{ $partner->address[0]->complement ?? ''}}" fgroup-class="col-md-6" enable-old-support/>

            <x-adminlte-input name="neighborhood" id="neighborhood" label="Bairro:" value="{{ $partner->address[0]->neighborhood ?? ''}}" placeholder="Informe o bairro" fgroup-class="col-md-6" enable-old-support/>
        </div>
        <div class="row">
            <x-adminlte-select name="country_id" id="country-id" label="País:" fgroup-class="col-md-4" enable-old-support>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ isset($partner->address[0]->country_id) && $country->id == $partner->address[0]->country_id ? "selected" : "" }}>{{ $country->name }}</option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-select name="state_id" id="state-id" label="Estado:" fgroup-class="col-md-4" enable-old-support>
                @foreach($states as $state)
                    <option value="{{ $state->id }}" {{ isset($partner->address[0]->state_id) && $state->id == $partner->address[0]->state_id ? "selected" : "" }}>{{ $state->name }}</option>
                @endforeach
            </x-adminlte-select>

            <x-adminlte-select name="city_id" id="city-id" label="Cidade:" fgroup-class="col-md-4" enable-old-support>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}" {{ isset($partner->address[0]->city_id) && $city->id == $partner->city_id ? "selected" : "" }}>{{ $city->name }}</option>
                @endforeach
            </x-adminlte-select>
        </div>
    </div>
</div>
