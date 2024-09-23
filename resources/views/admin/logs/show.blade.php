@extends('adminlte::page')

@section('title', 'Visualizar Log')

@section('content_header')
    <h1>Visualizar Log</h1>
@stop

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $log->id }}&nbsp;</dd>
                        <dt>Operação:</dt>
                        <dd>{{ $log->operation }}&nbsp;</dd>
                        <dt>Descrição:</dt>
                        <dd>{{ $log->description }}&nbsp;</dd>
                        <dt>Data/Hora :</dt>
                        <dd>{{ $log->created }}&nbsp;</dd>
                        <dt>Módule:</dt>
                        <dd>{{ $log->module->name }}&nbsp;</dd>
                        <dt>Usuário:</dt>
                        <dd>{{ $log->user->name }}&nbsp;</dd>
                        <dt>E-mail:</dt>
                        <dd>{{ $log->user->email }}&nbsp;</dd>
                        <dt>IP:</dt>
                        <dd>{{ $log->user_ip }}&nbsp;</dd>
                    </dl>                
                   
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">                                   
                                    <a href="{{ route('admin.logs.index') }}" class="btn btn-warning">
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
    <script  type="text/javascript" src="{{ asset('js/admin/log-delete.js') }}"></script>
@endpush