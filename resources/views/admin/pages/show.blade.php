@extends('adminlte::page')

@section('title', 'Visualizar Página')

@section('content_header')
    <h1>Visualizar Página</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $page->id }}&nbsp;</dd>
                        <dt>Título:</dt>
                        <dd>{{ $page->title }}&nbsp;</dd>
                        <dt>Descrição Abreviada:</dt>
                        <dd>{{ $page->description }}&nbsp;</dd>
                        <dt>Data Publicação:</dt>
                        <dd>{{ $page->date_inital }}&nbsp;</dd>
                        <dt>Expira em:</dt>
                        <dd>{{ $page->date_final }}&nbsp;</dd>
                        <dt>Status:</dt>
                        <dd>{{ $page->status }}&nbsp;</dd>
                        <dt>Mostrar no menu:</dt>
                        <dd>{{ $page->show_in_menu }}&nbsp;</dd>
                        <dt>Conteúdo:</dt>
                        <dd>{!! $page->content !!}&nbsp;</dd>
                    </dl>                
                   
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>
                                   
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
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
    <script  type="text/javascript" src="{{ asset('js/admin/page-delete.js') }}"></script>
@endpush