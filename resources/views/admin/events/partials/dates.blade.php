@php
    $key = isset($key) ? $key : 0;
    $config_date = ['format' => 'DD/MM/YYYY'];
    $config_hour = ['format' => 'HH:mm'];
@endphp    
<tr>
    <td>
        <x-adminlte-input-date name="start_date[{{$key}}]" id="start_date_{{$key}}" placeholder="DD/MM/YYYY" :config="$config_date" value="">
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-lg fa-calendar"
                    title="Selecione a data inicial do evento"/>
             </x-slot>
        </x-adminlte-input-date>
    </td>
    <td>
        <x-adminlte-input-date name="start_hour[{{$key}}]" id="start_hour_{{$key}}" placeholder="00:00" :config="$config_hour">
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fa fa-lg fa-clock"
                    title="Selecione a hora inicial do evento"/>
             </x-slot>
        </x-adminlte-input-date>
    </td>
    <td>
        <x-adminlte-input-date name="end_date[{{$key}}]" id="end_date_{{$key}}" placeholder="DD/MM/YYYY" :config="$config_date" value="">
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fas fa-lg fa-calendar"
                    title="Selecione a data final do evento"/>
             </x-slot>
        </x-adminlte-input-date>
    </td>
    <td>
        <x-adminlte-input-date name="end_hour[{{$key}}]" id="end_hour_{{$key}}" placeholder="00:00" :config="$config_hour" value="">
            <x-slot name="appendSlot">
                <x-adminlte-button icon="fa fa-lg fa-clock"
                    title="Selecione a hora final do evento"/>
             </x-slot>
        </x-adminlte-input-date>
    </td>
    <td>
        <x-adminlte-button theme="danger" icon="fa fa-fw fa-lg fa-trash" title="Remover" class="remove" />      
    </td>
</tr>