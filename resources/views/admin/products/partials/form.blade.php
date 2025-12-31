@csrf
<input type="hidden" name="unity" value="UN" />
<div class="box-body">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-pills ml-auto p-1">
                        <li class="nav-item"><a class="nav-link active" href="#tab_purchase" data-toggle="tab">Dados Compra</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_sale" data-toggle="tab">Dados Venda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_seo" data-toggle="tab">SEO</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_shipping" data-toggle="tab">Envio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_stock" data-toggle="tab">Estoque</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_photos" data-toggle="tab">Fotos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_keywords" data-toggle="tab">Palavras-Chave</a></li>

                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_purchase">
                            @include('admin.products.partials.tab_purchase')
                        </div>
                         <div class="tab-pane" id="tab_sale">
                            @include('admin.products.partials.tab_sale')
                        </div>
                        <div class="tab-pane" id="tab_seo">
                            @include('admin.products.partials.tab_seo')
                        </div>
                        <div class="tab-pane" id="tab_shipping">
                            @include('admin.products.partials.tab_shipping')
                        </div>
                        <div class="tab-pane" id="tab_stock">
                            @include('admin.products.partials.tab_stock')
                        </div>
                        <div class="tab-pane" id="tab_photos">
                            @include('admin.products.partials.tab_photos')
                        </div>
                        <div class="tab-pane" id="tab_keywords">
                            @include('admin.products.partials.tab_keywords')
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </div>
</div>
<div class="box-footer">
     <a href="{{ route('admin.products.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Cancelar</a>
    <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
</div>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js" integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/utils/maskField.js') }}"></script>
@endpush
