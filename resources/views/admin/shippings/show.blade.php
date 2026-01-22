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
                        <dd>{{ $shipping->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $shipping->name }}&nbsp;</dd>
                        <dt>Descrição:</dt>
                        <dd>{!! $shipping->description !!}&nbsp;</dd>
                        <dt>Data Publicação:</dt>
                        <dd>{{ $shipping->date_begin }}&nbsp;</dd>
                        <dt>Expira em:</dt>
                        <dd>{{ $shipping->date_end }}&nbsp;</dd>
                        <label>Regras</label>
                        <dt>Estado: </dt>
		    	        <dd>{{ optional($shipping->state)->name }}&nbsp;</dd>
				        <dt>Cidade: </dt>
		    	        <dd>{{ optional($shipping->city)->name }}&nbsp;</dd>
				        <dt>Produto: </dt>
		    	        <dd>{{ optional($shipping->product)->name }}&nbsp;</dd>
				        <dt>Total do Pedido: </dt>
		    	        <dd>{{ number_format($shipping->total,2, ",",".") }}&nbsp;</dd>
		    	        <dt>Valor: </dt>
			            <dd>{{ number_format($shipping->pricel,2, ",",".")  }}&nbsp;</dd>
			            <dt>Prazo de Entrega:</dt>
			            <dd>{{ $shipping->delivery_time }} dias&nbsp;</dd>
			            <dt>Status: </dt>
			            <dd>{{ $shipping->status }}&nbsp;</dd>
                        <dt>Criado em:</dt>
                        <dd>{{ $shipping->created_formatted }}&nbsp;</dd>
                        <dt>Modificado em:</dt>
                        <dd>{{ $shipping->modified }}&nbsp;</dd>
                    </dl>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.shippings.edit', $shipping->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.shippings.destroy', $shipping->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.shippings.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.shippings.create') }}" class="btn btn-primary">
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
