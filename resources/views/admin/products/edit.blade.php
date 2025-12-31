@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
    <h1>Editar Produto</h1>
@stop

@section('adminlte_css')
     <link rel="stylesheet" href="{{ asset('css/file-upload.css') }}">
@stop

@section('plugins.BootstrapSwitch', true)
@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.products.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js" integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/admin/utils/maskField.js') }}"></script>
    <script src="{{ asset('js/admin/utils/multiupload.js') }}"></script>
@stop
