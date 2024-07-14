@extends('adminlte::page')

@section('title', 'Visualizar Banner')

@section('content_header')
    <h1>Visualizar Banner</h1>
@stop

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
                    {{ $banner->html }} 
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
                        <img src="{{ url('images/banners/'.$banner->image) }}" >
                    </a>                    
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="actions">
                                <ul>
                                    <li>Editar </li>
                                    <li>Excluir</li>
                                    <li>Listar</li>
                                    <li>Novo Banner</li>       
                                </ul>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>    
@stop