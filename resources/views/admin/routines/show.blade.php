@extends('adminlte::page')

@section('title', 'Visualizar Rotina')

@section('content_header')
    <h1>Visualizar Rotina</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $routine->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $routine->name }}&nbsp;</dd>
                        <dt>Descrição:</dt>
                        <dd>{{ $routine->description }}&nbsp;</dd>
                        <dt>Módulo:</dt>
                        <dd>{{ optional($routine->module)->name }}&nbsp;</dd>
                        <dt>Página:</dt>
                        <dd>{{ $routine->page }}&nbsp;</dd>
                        <dt>Ao Clicar:</dt>
                        <dd>{{ $routine->onclick }}&nbsp;</dd>
                        <dt>Qtde registos:</dt>
                        <dd>{{ $routine->quantity }}&nbsp;</dd>
                        <dt>Visível:</dt>
                        <dd>{{ $routine->visible }}&nbsp;</dd>
                        <dt>Ordem:</dt>
                        <dd>{{ $routine->order }}&nbsp;</dd>
                        <dt>Imagem:</dt>
                        <dd>{{ $routine->btn_image }}&nbsp;</dd>
                        <dt>Mostrar:</dt>
                        <dd>{{ $routine->show }}&nbsp;</dd>
                    </dl>                
                    
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.routines.edit', $routine->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.routines.destroy', $routine->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>
                                   
                                    <a href="{{ route('admin.routines.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.routines.create') }}" class="btn btn-primary">
                                        <i class="fa fa-file"></i> Adicionar
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
    <script  type="text/javascript" src="{{ asset('js/admin/routine-delete.js') }}"></script>
@endpush