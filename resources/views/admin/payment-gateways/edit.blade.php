@extends('adminlte::page')

@section('title', 'Editar Integradora de Pagamento')

@section('content_header')
    <h1>Editar BannIntegradora de Pagamentoer</h1>
@stop

@section('plugins.BootstrapSwitch', true)

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.payment-gateways.update', $paymentGateway->id) }}">
                        @method('PUT')
                        @include('admin.payment-gateways.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop