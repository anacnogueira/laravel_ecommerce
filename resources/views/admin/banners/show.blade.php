@extends('adminlte::page')

@section('title', 'Visualizar Banner')

@section('content_header')
    <h1>Visualizar Banner</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <dl>
                        <dt>ID:</dt>
                        <dd>{{ $banner->id }}&nbsp;</dd>
                        <dt>Nome:</dt>
                        <dd>{{ $banner->name }}&nbsp;</dd>
                        <dt>Dimensão:</dt>
                        <dd>{{ $banner->dimension }}&nbsp;</dd>
                        <dt>Data Publicação:</dt>
                        <dd>{{ $banner->scheduled_date }}&nbsp;</dd>
                        <dt>Expira em:</dt>
                        <dd>{{ $banner->expire_date }}&nbsp;</dd>
                    </dl>                
                    @if (!empty($banner->html)) 
                    {!! $banner->html !!} 
                    @elseif (!empty($banner->image))
                    @if (!empty($banner->url))
                        @php
                            $url = $banner->url;
                        @endphp    
                    @else
                        @php
                            $url = '#';
                        @enhphp    
                    @endif
                    <a href="{{ $url }}">
                        <img src="{{ Storage::url($banner->image) }}" >
                    </a>                    
                    @endif
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-12">
                            <div class="btn-group" style="display: inline">
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-success">
                                        <i class="fa fa-pen"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="frm-delete" style="display: inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" title="Delete">
                                            <i class="fa fa-trash"></i>  Excluir
                                        </button>
                                    </form>
                                   
                                    <a href="{{ route('admin.banners.index') }}" class="btn btn-warning">
                                        <i class="fa fa-list-alt"></i> Listar
                                    </a>
                                    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
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
    <script  type="text/javascript" src="{{ asset('js/admin/banner-delete.js') }}"></script>
@endpush