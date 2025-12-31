@extends('adminlte::page')

@section('title', 'Visualizar Produto')

@section('content_header')
    <h1>Visualizar Produto</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <fieldset>
                            <legend>Dados de compra</legend>
                            <dt>Código:</dt>
                            <dd>{{ $product->code }}&nbsp;</dd>
                            <dt>Custo:</dt>
                            <dd>{{  number_format($product->cost_price, 2, ",", ".") }}&nbsp;</dd>
                            <dt>Fornecedor:</dt>
                            <dd>{{ $product->contact->name }}&nbsp;</dd>
                            <dt>Marca:</dt>
                            <dd>{{ $product->brand->name }}&nbsp;</dd>
                            <dt>Origem:</dt>
                            <dd>{{ $product->origin }}&nbsp;</dd>
                        </fieldset>
                        <fieldset>
                            <legend>Dados de Venda</legend>
                            <dt>Nome:</dt>
                            <dd>{{ $product->name }}&nbsp;</dd>
                            <dt>Categoria:</dt>
                            <dd>{{  $product->category->name }}&nbsp;</dd>
                            <dt>Preço de venda:</dt>
                            <dd>{{ number_format($product->selling_price, 2, ",", ".") }}&nbsp;</dd>
                            <dt>Descrição:</dt>
                            <dd>{!! $product->text !!}&nbsp;</dd>
                            <dt>Destaque:</dt>
                            <dd>{{ $product->highlight }}&nbsp;</dd>
                            <dt>Novidade:</dt>
                            <dd>{{ $product->news }}&nbsp;</dd>
                        </fieldset>
                        <fieldset>
                            <legend>SEO</legend>
                            <dt>Título da página:</dt>
                            <dd>{{ $product->meta_title }}&nbsp;</dd>
                            <dt>Permalink Antigo:</dt>
                            <dd>{{  $product->permalink_old }}&nbsp;</dd>
                            <dt>Novo Permalink:</dt>
                            <dd>{{ $product->permalink_old }}&nbsp;</dd>
                            <dt>Descrição Abreviada:</dt>
                            <dd>{{ $product->description }}&nbsp;</dd>
                        </fieldset>
                        <fieldset>
                            <legend>Envio</legend>
                            <dt>Comprimento:</dt>
                            <dd>{{ $product->length }}&nbsp;</dd>
                            <dt>Largura:</dt>
                            <dd>{{  $product->width }}&nbsp;</dd>
                            <dt>Altura:</dt>
                            <dd>{{ $product->height }}&nbsp;</dd>
                            <dt>Peso:</dt>
                            <dd>{{ number_format($product->gross_weight,3,",",".") }}&nbsp;</dd>
                        </fieldset>
                        <fieldset>
                            <legend>Estoque</legend>
                            <dt>Status:</dt>
                            <dd>{{ $product->status }}&nbsp;</dd>
                            <dt>Coluna:</dt>
                            <dd>{{  $product->col }}&nbsp;</dd>
                            <dt>Fileira:</dt>
                            <dd>{{ $product->row }}&nbsp;</dd>
                            <dt>Estoque Atual:</dt>
                            <dd>{{ $product->current_stock }}&nbsp;</dd>
                            <dt>Estoque Máximo:</dt>
                            <dd>{{ $product->maximum_stock }}&nbsp;</dd>
                            <dt>Estoque Minímo:</dt>
                            <dd>{{ $product->minimum_stock }}&nbsp;</dd>
                        </fieldset>
                        <fieldset>
                            <legend>Fotos</legend>
                            <div class="row">
                            @for ($idx=0; $idx < count($product->photos); $idx++)
                                <div class="col-md-4" style="height: 235px;">
                                    <a href="{{ $product->photos[$idx]->photo_ori }}" class="imagem iframe.fancybox">
                                        <img src="{{ Storage::url($product->photos[$idx]->photo_redim) }}" alt="" class="img-responsive" />
                                    </a>
                                </div>
                            @endfor
                        </fieldset>
                    </dl>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>

                                    <a href="{{ route('admin.products.duplicate', $product->id) }}" class="btn btn-info">
                                        <i class="fa fa-clone"></i> Duplicar
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.products.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                                        <i class="fa fa-file"></i> Adicionar
                                    </a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script  type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
@endpush
