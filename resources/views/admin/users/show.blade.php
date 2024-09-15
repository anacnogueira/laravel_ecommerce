@extends('adminlte::page')

@section('title', 'Visualizar Usuário')

@section('content_header')
    <h1>Visualizar Usuário</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $user->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $user->name }}&nbsp;</dd>
                        <dt>E-mail:</dt>
                        <dd>{{ $user->email }}&nbsp;</dd>
                        <dt>Telefone:</dt>
                        <dd>{{ $user->telephone }}&nbsp;</dd>
                        <dt>Celular:</dt>
                        <dd>{{ $user->cellular }}&nbsp;</dd>
                        <dt>Status:</dt>
                        <dd>{{ $user->status }}&nbsp;</dd>
                        <dt>Criado em:</dt>
                        <dd>{{ $user->created }}&nbsp;</dd>
                        <dt>Modificado em:</dt>
                        <dd>{{ $user->modified }}&nbsp;</dd>
                    </dl>                
                    
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>
                                   
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
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
    <script  type="text/javascript" src="{{ asset('js/admin/btn-delete.js') }}"></script>
@endpush