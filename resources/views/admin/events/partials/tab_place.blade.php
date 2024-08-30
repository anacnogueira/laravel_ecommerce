<div class="row">
 	<div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <x-adminlte-input name="cep" label="CEP:*" value="{{ $event->cep ?? ''}}" placeholder="99999-999" enable-old-support/>
            </div>
            <div class="col-md-5">
                <x-adminlte-input name="address" label="Endereço:" value="{{ $event->address ?? ''}}" placeholder="Insira o nome da rua" enable-old-support/>
            </div>
            <div class="col-md-2">
                <x-adminlte-input name="number" label="Número:" value="{{ $event->number ?? ''}}" placeholder="Insira o número do endereço" enable-old-support/>
            </div>
            <div class="col-md-3">
                <x-adminlte-input name="complement" label="Complemento:" value="{{ $event->complment ?? ''}}" placeholder="Insira o complmento do endereço, se houver" enable-old-support/>
            </div>            
        </div>
        <div class="row">
            <div class="cold-md-3">
                <x-adminlte-input name="neighborhood" label="Bairro:*" value="{{ $event->neighborhood ?? ''}}" placeholder="Insira o bairro do evento" enable-old-support/>
            </div>
            <div class="cold-md-3">
                <x-adminlte-input name="country_id" label="Páis:*" value="{{ $event->country_id ?? ''}}" placeholder="Insira o país do eventos" enable-old-support/>
            </div>
            <div class="cold-md-3">
                <x-adminlte-input name="state_id" label="Estado:*" value="{{ $event->state_id ?? ''}}" placeholder="Insira o estado do evento" enable-old-support/>
            </div>
            <div class="cold-md-3">
                <x-adminlte-input name="city_id" label="Cidade:*" value="{{ $event->city_id ?? ''}}" placeholder="Insira a cidade do evento" enable-old-support/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @php
                    $config = [
                        'show_map' => (isset($event) && $event->show_map == 'S') || !isset($event) ? true : false,
                    ];
                @endphp    
                <x-adminlte-input-switch 
                    name="show_map"
                    label="Mostrar mapa:*"
                    data-on-color="success"
                    data-off-color="danger"
                    data-on-text="Sim"
                    data-off-text="Não"
                    :config="$config"
                    checked="$config['show_map']" />
            </div>
            <div class="col-md-6">
            @php
                    $config = [
                        'show_link_map' => (isset($event) && $event->show_link_map == 'S') || !isset($event) ? true : false,
                    ];
                @endphp    
                <x-adminlte-input-switch 
                    name="show_link_map"
                    label="Mostrar link do mapa:*"
                    data-on-color="success"
                    data-off-color="danger"
                    data-on-text="Sim"
                    data-off-text="Não"
                    :config="$config"
                    checked="$config['show_link_map']" /> 
            </div>
        </div>
    </div>
</div>    