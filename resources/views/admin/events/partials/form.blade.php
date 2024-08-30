@csrf
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-pills ml-auto p-1">
                        <li class="nav-item"><a class="nav-link active" href="#tab_general" data-toggle="tab">Informações Gerais</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_date_hour" data-toggle="tab">Data e Hora</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_place" data-toggle="tab">Local</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_prefessional" data-toggle="tab">Informações do Profissional</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_general">
                            @include('admin.events.partials.tab_general')
                        </div>
                        <div class="tab-pane" id="tab_date_hour">
                            @include('admin.events.partials.tab_date_hour')
                        </div>
                        <div class="tab-pane" id="tab_place">
                            @include('admin.events.partials.tab_place')
                        </div>
                        <div class="tab-pane" id="tab_prefessional">
                            @include('admin.events.partials.tab_prefessional')
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
</div>
<div class="box-footer">
     <a href="{{ route('admin.events.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
    <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
</div>  
