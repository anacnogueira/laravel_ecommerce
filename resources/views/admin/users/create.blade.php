@extends('adminlte::page')

@section('title', 'Inserir Usuário')

@section('content_header')
    <h1>Novo Usuário</h1>
@stop

@section('plugins.BootstrapSwitch', true)

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @include('admin.users.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop