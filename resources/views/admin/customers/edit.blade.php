@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content_header')
    <h1>Editar Cliente</h1>
@stop

@section('plugins.TempusDominusBs4', true)
@section('plugins.BootstrapSwitch', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.customers.update', $customer->id) }}">
                        @method('PUT')
                        @include('admin.customers.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
