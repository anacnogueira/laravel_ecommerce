@extends('adminlte::page')

@section('title', 'Inserir Grupo')

@section('content_header')
    <h1>Novo Grupo</h1>
@stop

@section('plugins.BootstrapSwitch', true)

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.user-groups.store') }}">
                        @include('admin.user-groups.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop