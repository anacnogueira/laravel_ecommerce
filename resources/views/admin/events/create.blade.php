@extends('adminlte::page')

@section('title', 'Inserir Evento')

@section('content_header')
    <h1>Novo Evento</h1>
@stop

@section('plugins.TempusDominusBs4', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
                        @include('admin.events.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script  type="text/javascript" src="{{ asset('js/admin/image-preview.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.9/jquery.inputmask.min.js" integrity="sha512-F5Ul1uuyFlGnIT1dk2c4kB4DBdi5wnBJjVhL7gQlGh46Xn0VhvD8kgxLtjdZ5YN83gybk/aASUAlpdoWUjRR3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/utils/maskField.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/utils/event-dates-add.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/utils/jquery.selects.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/admin/utils/get-cities.js') }}"></script>
    <script  type="text/javascript" src="{{ asset('js/utils/get-cep.js') }}"></script>
@endpush
