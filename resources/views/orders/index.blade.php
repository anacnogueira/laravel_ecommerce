@extends('layouts.app')

@section('title', $title)

@section('content')
    <nav class="breadcrumb">
        <ul>
            <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
            <li><a href="{{ route('customer.index') }}">Minha Conta</a></li>
            <li><span>{{ $title }}</span></li>
        </ul>
    </nav>
    <div class="container">
        <h1>{{ $title }}</h1>
       <div class="orders">
            <!-- Filtros -->
            @if ($type == "numero" || $type == "data")
                <div class="filters">
                    <form name="frm_order" method="get">
                        @if ($type == "numero")
                            <div class="form-group">
                                <label for="order-id">Nº do pedido:*</label>
                                <input
                                    type="text"
                                    name="order_id"
                                    id="order-id"
                                    value="{{ request()->query("order_id") }}"
                                    required
                                />
                            </div>
                        @endif

                        @if ($type == "data")
                            <h2>Período</h2>
                            <div class="dates">
                                <div class="form-group">
                                    <label for="date-from">De:</label>
                                    <input
                                        type="date"
                                        name="date_from"
                                        id="date-from"
                                        value="{{ request()->query("date_from") }}"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="date-to">Até:</label>
                                    <input
                                        type="date"
                                        name="date_to"
                                        id="date-to"
                                        value="{{ request()->query("date_to") }}"
                                    />
                                </div>
                            </div>
                        @endif
                        <input type="submit" value="Filtrar" />
                    </form>
                </div>

            @endif
            <p>Total de  {{ $orders->count() }} pedidos encontrados </p>
            @if(isset($orders))
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <th><a href="?sort=orders.id&direction={{ $direction }}">Nº Pedido</a</th>
                            <th><a href="?sort=orders.created&direction={{ $direction }}">Data</a></th>
                            <th><a href="?sort=orders.value_total&direction={{ $direction }}">Total</a></th>
                            <th><a href="?sort=orders.payment_method_id&direction={{ $direction }}">Forma de pagamento</a></th>
                            <th>Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ str_pad($order->id, 10,0,STR_PAD_LEFT) }}</td>
                                <td>{{ $order->created_formatted }}</td>
                                <td>R$ {{ number_format($order->value_total,2,',','.') }}</td>
                                <td>{{ $order->paymentMethod->name }}</td>
                                <td><a href="{{ route('orders.show', $order->id) }}" class="button">Detalhes do pedido</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        @if (method_exists($orders,'links'))
            <div class="pagination">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/order-index.css') }}">
@endpush
