@extends('adminlte::page')

@section('title', 'Editar Pergunta Frequente')

@section('content_header')
    <h1>Editar Pergunta Frequente</h1>
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.Summernote', true)

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.faqs.update', $faq->id) }}">
                        @method('PUT')
                        @include('admin.faqs.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop