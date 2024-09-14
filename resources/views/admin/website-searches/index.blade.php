@extends('adminlte::page')

@section('title', 'Listar Pesquisas no site')

@section('content_header')
    <h1>Pesquisas no site</h1>
@stop

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)


@section('content')
    @php
        $data = [];

        $heads = [
            ['label' => 'ID', 'width' => 5],
            'Palavra Chave',
            'IP',
            'Data Pesquisa'
        ];

        foreach($websiteSearches  as $key => $websiteSearch) {
            $data[$key] = [
                $websiteSearch->id,
                $websiteSearch->keyword,
                $websiteSearch->ip,
                $websiteSearch->created,               
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
                    <x-adminlte-datatable id="table-website-search" :heads="$heads" head-theme="light" hoverable bordered with-buttons>
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