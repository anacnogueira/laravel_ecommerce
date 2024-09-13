@extends('adminlte::page')

@section('title', 'Visualizar Pergunta Frequente')

@section('content_header')
    <h1>Visualizar Pergunta Frequente</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $faq->id }}&nbsp;</dd>
                        <dt>Pergunta:</dt>
                        <dd>{!! $faq->question !!}&nbsp;</dd>
                        <dt>Resposta:</dt>
                        <dd>{!! $faq->answer !!}&nbsp;</dd>
                        <dt>Ordem:</dt>
                        <dd>{{ $faq->order }}&nbsp;</dd>
                        <dt>Status:</dt>
                        <dd>{{ $faq->status }}&nbsp;</dd>                       
                    </dl>                
                   
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>
                                   
                                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
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
    <script  type="text/javascript" src="{{ asset('js/admin/faq-delete.js') }}"></script>
@endpush