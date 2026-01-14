@extends('adminlte::page')

@section('title', 'Listar Pedidos')

@section('content_header')
    <h1>Pedidos</h1>
    <h2>Cliente: {{  $customer->name }}</h2>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)

@section('content')
    @php
        $data = [];

        $heads = [
            'Nº  Pedido',
            'Total',
            'Data Compra',
            'Forma de Pagamento',
            'Status',
            ['label' => 'Ações', 'no-export' => true, 'width' => 5],
        ];

        foreach($orders  as $key => $order) {

            $data[$key] = [
                str_pad($order->id, 10,0,STR_PAD_LEFT),
                $order->value_total,
                $order->created,
                $order->paymentMethod->name,
                $order->orderStatus->name,
                '<nobr><a href="'. route('admin.customers.orders.edit', [$customer->id, $order->id]).'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                <i class="fa fa-lg fa-fw fa-pen"></i></a>
                <form action="'.route('admin.customers.orders.destroy', [$customer->id, $order->id]) .'" method="POST" class="frm-delete" style="display: inline">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Excluir">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                </form>
                <a href="'.route('admin.customers.orders.show', [$customer->id, $order->id]) .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Detalhes">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>
                </nobr>',
            ];
        }

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],

        ];
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">

                <div class="card-body">
                    <x-adminlte-datatable id="table-contact-order" :heads="$heads" head-theme="light" hoverable bordered with-buttons>
                        @foreach($config['data'] as $row)
                            <tr>
                                @foreach($row as $cell)
                                    <td>{!! $cell !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-success" title="Voltar">
        <i class="fa fa-lg fa-fw fa-arrow-left"></i>
    </a>
@stop



@push('js')
    <script  type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/utils/translateDatatable.js') }}"></script>
    <script type="text/javascript" defer>
        translate("#table-contact-order");
    </script>
@endpush
