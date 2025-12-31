@extends('adminlte::page')

@section('title', 'Visualizar Avaliação')

@section('content_header')
    <h1>Visualizar Avaliação</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $comment->id }}&nbsp;</dd>
                        <dt>Produto:</dt>
                        <dd>{{ $comment->product->name }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $comment->contact ? $comment->contact->name : $comment->name }}&nbsp;</dd>
                        <dt>E-mail:</dt>
                        <dd>{{ $comment->email }}&nbsp;</dd>
                        <dt>Nota:</dt>
                        <dd>{{ $comment->rate }}&nbsp;</dd>
                        <dt>Comentário:</dt>
                        <dd>{{ $comment->text }}&nbsp;</dd>
                        <dt>IP:</dt>
                        <dd>{{ $comment->ip }}&nbsp;</dd>
                        <dt>Status:</dt>
                        <dd>{{ $comment->status }}&nbsp;</dd>
                        <dt>Criado em:</dt>
                        <dd>{{ $comment->created }}&nbsp;</dd>
                        <dt>Modificado em:</dt>
                        <dd>{{ $comment->modified }}&nbsp;</dd>
                    </dl>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.comments.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.comments.create') }}" class="btn btn-primary">
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
    <script  type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
@endpush
