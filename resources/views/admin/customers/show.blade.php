@extends('adminlte::page')

@section('title', 'Visualizar Cliente')

@section('content_header')
    <h1>Visualizar Cliente</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $customer->id }}&nbsp;</dd>
                        @if ($customer->type_person == 'pf')
                            <dt>Nome Completo:</dt>
                            <dd>{{ $customer->name }}&nbsp;</dd>
                            <dt>CPF:</dt>
                            <dd>{{ $customer->cpf }}&nbsp;</dd>
                            <dt>Data Nascimento:</dt>
                            <dd>{{ $customer->date_birth }}&nbsp;</dd>
                            <dt>Sexo:</dt>
                            <dd>{{ $customer->gender }}&nbsp;</dd>
                        @else
                            <dt>Razão Social:</dt>
                            <dd>{{ $customer->name }}&nbsp;</dd>
                            <dt>CNPJ:</dt>
                            <dd>{{ $customer->cnpj }}&nbsp;</dd>
                            <dt>Inscrição Estadual:</dt>
                            <dd>{{ $customer->ie }}&nbsp;</dd>
                        @endif
                        <dt>Telefone:</dt>
                        <dd>{{ $customer->mobile }}&nbsp;</dd>
                        <dt>E-mail:</dt>
                        <dd>{{ $customer->email }}&nbsp;</dd>
                        <dt>Newsletter:</dt>
                        <dd>{{ $customer->newsletter }}&nbsp;</dd>
                        <dt>Criado em:</dt>
                        <dd>{{ $customer->created_formatted }}&nbsp;</dd>
                        <dt>Modificado em:</dt>
                        <dd>{{ $customer->modified }}&nbsp;</dd>
                    </dl>
                    <ul>
                        <li><a href="{{ route('admin.addresses.index', $customer->id) }}">Endereços</a></li>
                        <li><a href="{{ route('admin.customers.orders.index', $customer->id) }}">Pedidos</a></li>
                        <li><a href="{{ route('admin.customers.comments.index', $customer->id) }}">Comentários</a></li>
                    </ul>
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-success">
                                    <i class="fa fa-pen"></i> Editar
                                </a>
                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST"
                                    class="frm-delete" style="display: inline">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" title="Delete">
                                        <i class="fa fa-trash"></i> Excluir
                                    </button>
                                </form>

                                <a href="{{ route('admin.customers.index') }}" class="btn btn-warning">
                                    <i class="fa fa-list-alt"></i> Listar
                                </a>
                                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
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
    <script type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
@endpush
