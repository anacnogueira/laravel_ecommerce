@extends('adminlte::page')

@section('title', 'Editar Marca')

@section('content_header')
    <h1>Editar Marca</h1>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.Summernote', true)

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.brands.update', $brand->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.brands.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop