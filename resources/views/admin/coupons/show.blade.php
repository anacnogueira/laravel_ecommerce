@extends('adminlte::page')

@section('title', 'Visualizar Cupom')

@section('content_header')
    <h1>Visualizar Cupom</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $coupon->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $coupon->name }}&nbsp;</dd>
                        <dt>Descrição:</dt>
                        <dd>{!! $coupon->description !!}&nbsp;</dd>
                        <dt>Código:</dt>
                        <dd>{{ $coupon->code }}&nbsp;</dd>
                        <dt>Tipo:</dt>
                        <dd>{{ $coupon->discount_type }}&nbsp;</dd>
                        <dt>Desconto: </dt>
		    	        <dd>{{ number_format($coupon->discount_amount,2,",",".") }}&nbsp;</dd>
				        <dt>Valor Mínimo: </dt>
		    	        <dd>{{ number_format($coupon->total_amount,2,",",".") }}&nbsp;</dd>
				        <dt>Usuário logado: </dt>
		    	        <dd>{{ $coupon->customer_login }}&nbsp;</dd>
                        <dt>Frete Grátis: </dt>
		    	        <dd>{{ $coupon->free_shipping }}&nbsp;</dd>
                        <dt>Início:</dt>
				        <dd>{{ $coupon->from_date }}&nbsp;</dd>
				        <dt>Fim:</dt>
				        <dd>{{ $coupon->to_date }}&nbsp;</dd>
				        <dt>Uso por cupom:</dt>
				        <dd>{{ $coupon->uses_per_coupon }}&nbsp;</dd>
				        <dt>Uso por cliente:</dt>
				        <dd>{{ $coupon->uses_per_customer}}&nbsp;</dd>
				        <dt>Status:</dt>
				        <dd>{{ $coupon->status }}&nbsp;</dd>
				        <dt>Criado em:</dt>
                        <dd>{{ $coupon->created_formatted }}&nbsp;</dd>
                        <dt>Modificado em:</dt>
                        <dd>{{ $coupon->modified }}&nbsp;</dd>
                    </dl>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
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
