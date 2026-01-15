@extends('adminlte::page')

@section('title', 'Inserir Avaliação')

@section('content_header')
    <h1>Nova Avaliação</h1>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.BootstrapSlider', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.customers.comments.store', $customer->id) }}">
                        @include('admin.contact-comments.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
