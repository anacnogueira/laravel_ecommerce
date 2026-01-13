@extends('adminlte::page')

@section('title', 'Visualizar Endereço')

@section('content_header')
    <h1>Visualizar Endereço</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>z
                        <dt>Cliente:</dt>
                        <dd>{{ $customer->name }}&nbsp;</dd>
                        <dt>ID:</dt>
                        <dd>{{ $address->id }}&nbsp;</dd>
                        <dt>Título:</dt>
                        <dd>{{ $address->title }}&nbsp;</dd>
                        <dt>CEP:</dt>
                        <dd>{{ $address->cep }}&nbsp;</dd>
                        <dt>Endereço:</dt>
                        <dd>{{ $address->address .', ' . $address->number}}&nbsp;</dd>
                        @if (!empty($address->complement))
                            <dt>Complemento:</dt>
                            <dd>{{ $address->complement }}&nbsp;</dd>
                        @endif
                        <dt>Bairro:</dt>
                        <dd>{{ $address->neighborhood }}&nbsp;</dd>
                        <dt>País:</dt>
                        <dd>{{ $address->country->name }}&nbsp;</dd>
                        <dt>Estado:</dt>
                        <dd>{{ $address->state->name }}&nbsp;</dd>
                        <dt>Cidade:</dt>
                        <dd>{{ $address->city->name }}&nbsp;</dd>
                        <dt>Telefone:</dt>
                        <dd>{{ $address->phone }}&nbsp;</dd>
                        <dt>Criado em:</dt>
                        <dd>{{ $address->created }}&nbsp;</dd>
                        <dt>Modifcado em:</dt>
                        <dd>{{ $address->modified }}&nbsp;</dd>
                    </dl>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.addresses.edit', [$customer->id, $address->id]) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.addresses.destroy', [$customer->id, $address->id]) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.addresses.index', $customer->id) }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.addresses.create', $customer->id) }}" class="btn btn-primary">
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
