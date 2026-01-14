@extends('adminlte::page')

@section('title', 'Visualizar Pedido')

@section('content_header')
    <h1>Visualizar Pedido</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Dados do Cliente</h4>
                            <div class="form-group">
                                <label>ID:</label>
                                {{ $order->customer->id }}
                            </div>
                            <div class="form-group">
                                <label>Nome:</label>
                                {{ $order->customer->name }}
                            </div>
                            <div class="form-group">
                                <label>Telefone:</label>
                                {{ $order->customer->phone }}
                            </div>
                            <div class="form-group">
                                <label>Celular:</label>
                                {{ $order->customer->mobile }}
                            </div>
                            <div class="form-group">
                                <label>E-mail:</label>
                                {{ $order->customer->email }}
                            </div>
                            <div class="form-group">
                                <label>CPF:</label>
                                {{ $order->customer->cpf }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Entrega</h4>
                            <div class="form-group">
                                <label>Modalidade:</label>
                                {{ $order->type_shipping }}
                            </div>
                            <div class="form-group">
                                <label>Endereço:</label>
                                {{ $order->address->address .", ". $order->address->number}}
                            </div>
                            @if (!empty( $order->address->complement))
                            <div class="form-group">
                                <label>Complemento:</label>
                                {{ $order->address->complement}}
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Bairro:</label>
                                {{ $order->address->neighborhood }}
                            </div>
                            <div class="form-group">
                                <label>CEP:</label>
                                {{ $order->address->cep}}
                            </div>
                            <div class="form-group">
                                <label>País:</label>
                                {{ $order->address->country->name}}
                            </div>
                            <div class="form-group">
                                <label>Cidade/UF:</label>
                                {{ $order->address->city->name . '/' . $order->address->state->uf }}
                            </div>

                            <div class="form-group">
                                <label>Código Rastreio:</label>
                                {{ $order->tracking_code }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h4>Forma de Pagamento</h4>
                            <div class="form-group">
                                <label>Nome:</label>
                                {{ $order->paymentMethod->name }}
                            </div>
                            @if ($order->paymentMethod->name == "Cartão de Crédito")
                                <div class="form-group">
                                    <label>Parcelas:</label>
                                    {{ $order->installments }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Informações  do pedido</h4>
                            <div class="form-group">
                                <label>ID:</label>
                                {{ str_pad($order->id,10,0) }}
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>Cod.</th>
                                    <th>Produto</th>
                                    <th>Preço</th>
                                    <th>Qtde</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        @if ($item->product)
                                            <tr>
                                                <td>{{ $item->product->code }}</td>
                                                <td>{{ $item->product->name . '- ' . $item->product->brand->name }}</td>
                                                <td>{{ $item->value_unit }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->value_total }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right">Subtotal:</td>
                                        <td>{{  $order->value }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right">Frete:</td>
                                        <td>{{  $order->value_shipping }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right">Desconto:</td>
                                        <td>{{  $order->value_discount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-right">Total:</td>
                                        <td>{{  $order->value_total }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Histórico</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Adicionado em</th>
                                    <th>Cliente Informado</th>
                                    <th>Comentário  Enviado</th>
                                    <th>Status </th>
                                    <th>Comentários</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderLogs as $log)
                                        <tr>
                                            <td>{{ $log->created }}</td>
                                            <td>{{ $log->client_notified }}</td>
                                            <td>{{ $log->client_comment }}</td>
                                            <td>{{ $log->status->name }}</td>
                                            <td>{!! $log->comment !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.orders.edit', [$order->customer->id, $order->id]) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.orders.destroy', [$order->customer->id, $order->id]) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.orders.index', $order->customer->id) }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
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
