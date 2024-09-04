@extends('adminlte::page')

@section('title', 'Visualizar Forma de Pagamento')

@section('content_header')
    <h1>Visualizar Forma de Pagamento</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $paymentMethod->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $paymentMethod->name }}&nbsp;</dd>
                        <dt>Valor:</dt>
                        <dd>{{ $paymentMethod->value }}&nbsp;</dd>
                        <dt>Integradora:</dt>
                        <dd>{{ $paymentMethod->paymentGateway->name }}&nbsp;</dd>
                        <dt>N° de Vezes:</dt>
                        <dd>{{ $paymentMethod->installments }}&nbsp;</dd>
                        <dt>Juros a partir da parcela:</dt>
                        <dd>{{ $paymentMethod->installments_interest_rate }}&nbsp;</dd>
                        <dt>Valor minimo para parcelamento:</dt>
                        <dd>{{ $paymentMethod->installments_min_value }}&nbsp;</dd>
                        <dt>Taxa de Juros:</dt>
                        <dd>{{ $paymentMethod->interest_rate }}&nbsp;</dd>
                        <dt>Status:</dt>
                        <dd>{{ $paymentMethod->status }}&nbsp;</dd>
                    </dl>                
                    @if (!empty($paymentMethod->html)) 
                    {!! $paymentMethod->html !!} 
                    @endif

                    <img src="{{ Storage::url($paymentMethod->image) }}" >
                                      
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.payment-methods.edit', $paymentMethod->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.payment-methods.destroy', $paymentMethod->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>
                                   
                                    <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary">
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
    <script  type="text/javascript" src="{{ asset('js/admin/banner-delete.js') }}"></script>
@endpush