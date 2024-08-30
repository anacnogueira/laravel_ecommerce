@extends('adminlte::page')

@section('title', 'Inserir Evento')

@section('content_header')
    <h1>Novo Evento</h1>
@stop

@section('plugins.TempusDominusBs4', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.Summernote', true)

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                        @include('admin.events.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop