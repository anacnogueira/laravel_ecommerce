@extends('adminlte::page')

@section('title', 'Listar Eventos')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)
@section('plugins.BootstrapSwitch', true)

@section('content')
    @inject('statusChange', 'App\Services\StatusChangeService')
    @php
        $data = [];

        $heads = [
            ['label' => 'ID', 'width' => 5],
            'Nome',
            ['label' => 'Ativo', 'width' => 5],
            ['label' => 'Ações', 'no-export' => true, 'width' => 5],
        ];

        foreach($events  as $key => $event) {
            $status = $statusChange->returnStatusBullets("events", $event->status, $event->id);
            $data[$key] = [
                $event->id,
                $event->name,
                $status,
                '<nobr><a href="'. route('admin.events.edit', $event->id).'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                <i class="fa fa-lg fa-fw fa-pen"></i></a>
                <form action="'.route('admin.events.destroy', $event->id) .'" method="POST" class="frm-delete" style="display: inline">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Excluir">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                </form>
                <a href="'.route('admin.events.show', $event->id) .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Detalhes">
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
                <div class="card-header"> <a href="{{ route('admin.events.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-file"></i> Adicionar
                </a></div>
                <div class="card-body">
                    <x-adminlte-datatable id="table-banner" :heads="$heads" head-theme="light" hoverable bordered with-buttons>
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
@stop

@push('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/banner-status.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/banner-delete.js') }}"></script>
@endpush