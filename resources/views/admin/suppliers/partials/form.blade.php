@csrf
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-pills ml-auto p-1">
                        <li class="nav-item"><a class="nav-link active" href="#tab_general" data-toggle="tab">Dados Gerais</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_contact" data-toggle="tab">Contato</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_address" data-toggle="tab">Endereço</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_person_contact" data-toggle="tab">Pessoa de Contato</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_general">
                            @include('admin.suppliers.partials.tab_general')
                        </div>
                        <div class="tab-pane" id="tab_contact">
                            @include('admin.suppliers.partials.tab_contact')
                        </div>
                        <div class="tab-pane" id="tab_address">
                            @include('admin.suppliers.partials.tab_address')
                        </div>
                        <div class="tab-pane" id="tab_person_contact">
                            @include('admin.suppliers.partials.tab_person_contact')
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
</div>
<div class="box-footer">
     <a href="{{ route('admin.suppliers.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
    <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
</div>  