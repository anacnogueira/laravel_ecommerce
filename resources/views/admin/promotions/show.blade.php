@extends('adminlte::page')

@section('title', 'Visualizar shipping')

@section('content_header')
    <h1>Visualizar shipping</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $promotion->id }}&nbsp;</dd>
                        <dt>Produto:</dt>
                        <dd>{{ $promotion->product->name }}&nbsp;</dd>
                        <dt>Preço Original:</dt>
                        <dd>{{ number_format($promotion->product->selling_price,2,",",".") }}&nbsp;</dd>
                        <dt>Preço Promocional:</dt>
                        <dd>{{ number_format($promotion->price_promotion,2,",",".") }}&nbsp;</dd>
                        <dt>Início:</dt>
                        <dd>{{ $promotion->date_initial }}&nbsp;</dd>
                        <dt>Fim: </dt>
		    	        <dd>{{ $promotion->date_final }}&nbsp;</dd>
				        <dt>Status: </dt>
		    	        <dd>{{ $promotion->status }}&nbsp;</dd>
				        <dt>Back Friday: </dt>
		    	        <dd>{{ $promotion->black_friday }}&nbsp;</dd>
				        <dt>Criado em:</dt>
                        <dd>{{ $promotion->created_formatted }}&nbsp;</dd>
                        <dt>Modificado em:</dt>
                        <dd>{{ $promotion->modified }}&nbsp;</dd>
                    </dl>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.promotions.edit', $promotion->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.promotions.destroy', $promotion->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.promotions.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary">
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
