<div class="box-body">
    <div class="row">
        <div class="col-md-4">
            <h4>Dados do Cliente</h4>
            <div class="form-group">
                <label>Nome: </label>
                {{  $order->customer->name }}
            </div>
            <div class="form-group">
                <label>Telefone: </label>
                {{  $order->customer->phone }}
            </div>
            <div class="form-group">
                <label>Celular:</label>
                {{  $order->customer->mobile }}
            </div>

            <div class="form-group">
                <label>E-mail:  </label>
                {{  $order->customer->email }}
            </div>

            <div class="form-group">
                <label>CPF:  </label>
                {{  $order->customer->cpf }}
            </div>
        </div>
        <div class="col-md-4">
            <h4>Entrega</h4>
            <div class="form-group">
                <label>Entrega: </label>
                {{ $order->type_shipping;  }}
              </div>
              <div class="form-group">
                <label>Endereço: </label>
                {{ $order->address->address.', '.$order->address->number }}
              </div>

              @if(!empty($order->address->complement))
                <div class="form-group">
                  <label>Complemento: </label>
                  {{ $order->address->complement }}

                </div>
             @endif

              <div class="form-group">
                <label>Bairro: </label>
                {{ $order->address->neighborhood }}
              </div>

              <div class="form-group">
                <label>CEP: </label>
                {{ $order->address->cep }}
              </div>

              <div class="form-group">
                <label>País:</label>
                {{ $order->address->country->name }}
              </div>

              <div class="form-group">
                <label>Cidade/UF:</label>
                {{ $order->address->city->name . '/'. $order->address->state->uf }}
              </div>

              @if(!empty($order->address->phone))
                <div class="form-group">
                  <label>Telefone: </label>
                  {{ $order->address->phone }}
                </div>
              @endif
        </div>
        <div class="col-md-4">
            <h4>Forma de Pagamento</h4>
            <div class="form-group">
                <label>Nome:</label>
                {{ $order->paymentMethod->name;  }}
              </div>

              <div class="form-group">
                <label>Parcelas:</label>
                {{ $order->installments;  }}
              </div>

              <h4>Outras Informações</h4>

              <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="type" value="order">
                        <x-adminlte-input name="tracking_code" label="Código Rastreio:" value="{{ $order->tracking_code ?? ''}}" enable-old-support/>


                        <div class="form-group">
                            <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
                        </div>
                    </form>
                </div>
              </div>
        </div>
     </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Informações  do pedido</h4>
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
                <tr>
                    <td>{{ $item->product->code }}</td>
                    <td>{{ $item->product->name .' - '. $item->product->brand->name }}</td>
                    <td>{{ $item->value_unit }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->value_total }}</td>
                  </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                  <td colspan="4" class="text-right">Subtotal:</td>
                  <td>R$ {{ number_format($order->value + $order->value_discount,2,",",".") }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">Frete:</td>
                  <td>R$ {{ number_format($order->value_shipping,2,",",".") }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">Desconto:</td>
                  <td>R$ {{ number_format($order->value_discount,2,",",".") }}</td>
                </tr>
                <tr>
                  <td colspan="4" class="text-right">Total:</td>
                  <td>R$ {{ number_format($order->value_total,2,",",".") }}</td>
                </tr>
              </tfoot>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
            @method('PUT')
            @csrf
            <input type="hidden" name="type" value="log">
            <input type="hidden" name="email" value="{{ $order->customer->email }}">
            <h4>Status</h4>
            <x-adminlte-select name="order_status_id" label="Status:" enable-old-support>
                @foreach($orderStatuses as $orderStatus)
                    <option value="{{ $orderStatus->id }}" {{ isset($order->order_status_id) && $order->order_status_id == $orderStatus->id ? "selected" : "" }}>{{ $orderStatus->name }}</option>
                @endforeach
            </x-adminlte-select>

            @php
                $config = [
                    "height" => "100",
                    "toolbar" => [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                    ],
                ]
            @endphp
            <x-adminlte-text-editor name="comment" label="Comentário:" igroup-size="sm"  :config="$config"/>

            <div class="row">
                <div class="col-md-6">
                    <label>
                        <input type="checkbox" name="client_notified" value='S'> Notificar cliente
                    </label>
                </div>
                <div class="col-md-6">
                    <label>
                        <input type="checkbox" name="client_comment" value='S'> Enviar comentário ao cliente
                    </label>
                </div>
            </div>

            <div class="form-group">
                <x-adminlte-button type="submit" label="Salvar" theme="success" icon="fas fa-check"/>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>Histórico de Status</h4>
        <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Adicionado em</th>
                <th>Cliente Informado</th>
                <th>Comentário  Enviado</th>
                <th>Status</th>
                <th>Comentário</th>
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
<a href="{{ route('admin.orders.index') }}" class="btn btn-warning"><i class="fa fa-times"></i> Voltar</a>

<form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="frm-delete" style="display: inline">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit" class="btn btn-danger" title="Delete">
        <i class="fa fa-trash"></i>  Excluir
    </button>
</form>

