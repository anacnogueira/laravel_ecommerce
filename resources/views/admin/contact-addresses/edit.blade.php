@extends('adminlte::page')

@section('title', 'Editar Endereço')

@section('content_header')
    <h1>Editar Endereço</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.addresses.update', [$customer->id, $address->id]) }}">
                        @method('PUT')
                        @include('admin.contact-addresses.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
