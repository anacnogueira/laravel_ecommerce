@extends('adminlte::page')

@section('title', 'Inserir Status de Pedido')

@section('content_header')
    <h1>Novo Status de Pedido</h1>
@stop

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.order-status.store') }}">
                        @include('admin.order-status.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop