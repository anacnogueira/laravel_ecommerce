@extends('adminlte::page')

@section('title', 'Editar Página')

@section('content_header')
    <h1>Editar Página</h1>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.TempusDominusBs4', true)
@section('plugins.Summernote', true)

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.pages.update', $page->id) }}">
                        @method('PUT')
                        @include('admin.pages.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop