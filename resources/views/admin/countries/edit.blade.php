@extends('adminlte::page')

@section('title', 'Editar Páis')

@section('content_header')
    <h1>Editar Páis</h1>
@stop

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.countries.update', $country->id) }}">
                        @method('PUT')
                        @include('admin.countries.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop