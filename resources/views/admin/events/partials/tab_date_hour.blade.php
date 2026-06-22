<input type="hidden" name="all_event_dates" id="all-event-dates"
    value="{{ isset($event->eventDates) ? json_encode($event->eventDates) : '' }}" />
@php
    $config_date = ['format' => 'DD/MM/YYYY'];
    $config_hour = ['format' => 'HH:mm'];
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <x-adminlte-input-date name="start_date" placeholder="DD/MM/AAAA" :config="$config_date" fgroup-class="col-md-2">
                <x-slot name="appendSlot">
                    <x-adminlte-button icon="fas fa-lg fa-calendar" title="Selecione a data inicial do evento" />
                </x-slot>
            </x-adminlte-input-date>

            <x-adminlte-input-date name="start_hour" placeholder="00:00" :config="$config_hour" fgroup-class="col-md-2">
                <x-slot name="appendSlot">
                    <x-adminlte-button icon="fa fa-lg fa-clock" title="Selecione a hora inicial do evento" />
                </x-slot>
            </x-adminlte-input-date>

            <x-adminlte-input-date name="end_date" placeholder="DD/MM/AAAA" :config="$config_date" fgroup-class="col-md-2">
                <x-slot name="appendSlot">
                    <x-adminlte-button icon="fas fa-lg fa-calendar" title="Selecione a data final do evento" />
                </x-slot>
            </x-adminlte-input-date>

            <x-adminlte-input-date name="end_hour" id="end_hour" placeholder="00:00" :config="$config_hour"
                fgroup-class="col-md-2">
                <x-slot name="appendSlot">
                    <x-adminlte-button icon="fa fa-lg fa-clock" title="Selecione a hora final do evento" />
                </x-slot>
            </x-adminlte-input-date>

            <div class="form-group" fgroup-class="col-md-2">
                <x-adminlte-button style="margin-top: 3px;" class="btn-sm" id="add-event-date" type="button"
                    theme="primary" icon="fa fa-fw fa-lg fa-plus" />
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id='tbl_event_dates'>
                    <thead>
                        <tr>
                            <th>Data Inicial</th>
                            <th>Hora Inicial</th>
                            <th>Data Final</th>
                            <th>Hora Final</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
