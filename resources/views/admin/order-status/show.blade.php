@extends('adminlte::page')

@section('title', 'Visualizar Status do Pedido')

@section('content_header')
    <h1>Visualizar Status do Pedido</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $orderStatus->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $orderStatus->name }}&nbsp;</dd>
                        <dt>Valor:</dt>
                        <dd>{{ $orderStatus->value }}&nbsp;</dd>
                        <dt>Ordem:</dt>
                        <dd>{{ $orderStatus->order_status}}&nbsp;</dd>                       
                    </dl>           
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.order-status.edit', $orderStatus->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.order-status.destroy', $orderStatus->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>
                                   
                                    <a href="{{ route('admin.order-status.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.order-status.create') }}" class="btn btn-primary">
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