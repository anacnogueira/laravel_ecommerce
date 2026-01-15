@extends('adminlte::page')

@section('title', 'Editar Avaliação')

@section('content_header')
    <h1>Editar Avaliação</h1>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.BootstrapSlider', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.customers.comments.update', [$comment->contact_id, $comment->id]) }}">
                        @method('PUT')
                        @include('admin.contact-comments.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
