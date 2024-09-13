@extends('adminlte::page')

@section('title', 'Editar Status de Pedido')

@section('content_header')
    <h1>Editar Status de Pedido</h1>
@stop


@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.order-status.update', $orderStatus->id) }}">
                        @method('PUT')
                        @include('admin.order-status.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop