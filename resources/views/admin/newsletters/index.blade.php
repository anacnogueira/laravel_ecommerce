@extends('adminlte::page')

@section('title', 'Listar Newsletters')

@section('content_header')
    <h1>Newsletters</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)
@section('plugins.Sweetalert2', true)

@section('content')
    @php
        $data = [];

        $heads = [
            ['label' => 'ID', 'width' => 5],
            'E-mail',
            'Cliente',
            ['label' => 'Ações', 'no-export' => true, 'width' => 5],
        ];

        foreach ($newsletters as $key => $newsletter) {
            $data[$key] = [
                $newsletter->id,
                $newsletter->email,
                $newsletter->contact ? $newsletter->contact->id . ' - ' . $newsletter->contact->name : '',
                '<nobr><a href="' .
                route('admin.newsletters.edit', $newsletter->id) .
                '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                <i class="fa fa-lg fa-fw fa-pen"></i></a>
                <form action="' .
                route('admin.newsletters.destroy', $newsletter->id) .
                '" method="POST" class="frm-delete" style="display: inline">
                    <input type="hidden" name="_token" value="' .
                csrf_token() .
                '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Excluir">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                </form>
                <a href="' .
                route('admin.newsletters.show', $newsletter->id) .
                '" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Detalhes">
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
                <div class="card-header">
                    <a href="{{ route('admin.newsletters.create') }}" class="btn btn-sm btn-primary">
                        <i class="fa fa-lg fa-fw fa-file"></i> Adicionar
                    </a>
                    <a href="#" class="btn btn-sm btn-success">
                        <i class="fa fa-lg fa-fw fa-download"></i> Exportar Dados
                    </a>
                </div>
                <div class="card-body">
                    <x-adminlte-datatable id="table-newsletter" :heads="$heads" head-theme="light" hoverable bordered
                        with-buttons>
                        @foreach ($config['data'] as $row)
                            <tr>
                                @foreach ($row as $cell)
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



@push('js')
    <script type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/utils/translateDatatable.js') }}"></script>
    <script type="text/javascript" defer>
        translate("#table-newsletter");
    </script>
@endpush
