@extends('adminlte::page')

@section('title', 'Listar Logs')

@section('content_header')
    <h1>Logs de Sistema</h1>
    @if (Route::currentRouteName() == 'admin.logs.index')
        <small>últimas 24 horas</small>
    @else
        <small>Todos os logs</small>
    @endif    
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

@section('content')
    @php
        $data = [];

        $heads = [
            ['label' => 'ID', 'width' => 5],
            'Operação',
            'Data/Hora',
            'Módulo',
            'Usuário',
            ['label' => 'Ações', 'no-export' => true, 'width' => 5],
        ];

        foreach($logs  as $key => $log) {
            $data[$key] = [
                $log->id,
                $log->operation,
                $log->created,
                $log->module->name,
                $log->user->name,
                '<nobr><a href="'.route('admin.logs.show', $log->id) .'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Detalhes">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>
                </nobr>'
            ];
        }
        
        $config = [
            'data' => $data,
            'order' => [[0, 'desc']],
            'columns' => [null, null, null, null],
          
        ];
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">               
                <div class="card-body">
                    @if (Route::currentRouteName() == 'admin.logs.index')
                        <div class="card-header">
                            <a href="{{ route('admin.logs.search') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-lg fa-fw fa-search"></i> Pesquisar
                            </a>
                        </div>
                    @else
                        <div class="card-header">
                            <a href="{{ route('admin.logs.index') }}" class="btn btn-sm btn-primary">
                                <i class="fa fa-lg fa-fw fa-arrow-left"></i> Voltar
                            </a>
                        </div>   
                    @endif    
                    <x-adminlte-datatable id="table-log" :heads="$heads" head-theme="light" hoverable bordered with-buttons>
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