@extends('adminlte::page')

@section('title', 'Inserir Parceiro')

@section('content_header')
    <h1>Novo Parceiro</h1>
@stop

@section('plugins.BsCustomFileInput', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
                        @include('admin.partners.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script  type="text/javascript" src="{{ asset('js/admin/image-preview.js') }}"></script>
@endpush
