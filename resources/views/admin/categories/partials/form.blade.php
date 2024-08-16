@csrf
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-pills ml-auto p-1">
                        <li class="nav-item"><a class="nav-link active" href="#tab_general" data-toggle="tab">Geral</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_seo" data-toggle="tab">SEO</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_general">
                            @include('admin.categories.partials.tab_general')
                        </div>
                        <div class="tab-pane" id="tab_seo">
                            @include('admin.categories.partials.tab_seo')
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
</div>
<div class="box-footer">
     <a href="{{ route('admin.categories.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
    <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
</div>  
