@extends('adminlte::page')

@section('title', 'Editar Module')

@section('content_header')
    <h1>Editar Module</h1>
@stop

@section('plugins.BootstrapSwitch', true)

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.modules.update', $module->id) }}">
                        @method('PUT')
                        @include('admin.modules.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop