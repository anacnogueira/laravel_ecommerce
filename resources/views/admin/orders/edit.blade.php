@extends('adminlte::page')

@section('title', 'Editar Pedido')

@section('content_header')
    <h1>Editar Pedido</h1>
@stop

@section('plugins.Summernote', true)
@section('plugins.Sweetalert2', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    @include('admin.orders.partials.form')
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script  type="text/javascript" src="{{ asset('js/admin/utils/deleteConfirm.js') }}"></script>
@endpush
