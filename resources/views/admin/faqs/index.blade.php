@extends('adminlte::page')

@section('title', 'Listar Perguntas Frequentes')

@section('content_header')
    <h1>Perguntas Frequentes</h1>
@stop

@section('plugins.Sweetalert2', true)
@section('plugins.BootstrapSwitch', true)

@section('content')
    @inject('statusChange', 'App\Services\StatusChangeService')
    @php
        $data = [];

        $heads = [
            ['label' => 'ID', 'width' => 5],
            'Pergunta',
            'Ordem',
            ['label' => 'Ativo', 'width' => 5],
            ['label' => 'Ações', 'no-export' => true, 'width' => 5],
        ];

        foreach($faqs  as $key => $faq) {
            $status = $statusChange->returnStatusBullets("faqs", $faq->status, $faq->id);
            $data[$key] = [
                $faq->id,
                $faq->question,
                $faq->order,
                $status,
                '<nobr><a href="'. route('admin.faqs.edit', $faq->id).'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                <i class="fa fa-lg fa-fw fa-pen"></i></a>
                <form action="'.route('admin.faqs.destroy', $faq->id) .'" method="POST" class="frm-delete" style="display: inline">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Excluir">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                </form>
                <a href="'.route('admin.faqs.show', $faq->id) .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Detalhes">
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
                <div class="card-header"> <a href="{{ route('admin.faqs.create') }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-lg fa-fw fa-file"></i> Adicionar
                </a></div>
                <div class="card-body">
                    <x-adminlte-datatable id="table-faq" :heads="$heads" head-theme="light" hoverable bordered with-buttons>
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
    <script  type="text/javascript" src="{{ asset('js/admin/btn-status.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/btn-delete.js') }}"></script>
@endpush