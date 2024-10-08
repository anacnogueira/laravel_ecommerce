@extends('adminlte::page')

@section('title', 'Editar Forma de Pagamento')

@section('content_header')
    <h1>Editar Forma de Pagamento</h1>
@stop

@section('plugins.BootstrapSwitch', true)

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.payment-methods.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop