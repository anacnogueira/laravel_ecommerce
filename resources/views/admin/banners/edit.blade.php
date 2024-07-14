@extends('adminlte::page')

@section('title', 'Editar Banner')

@section('content_header')
    <h1>Editar Banner</h1>
@stop

@section('plugins.TempusDominusBs4', true)

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.banners.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop