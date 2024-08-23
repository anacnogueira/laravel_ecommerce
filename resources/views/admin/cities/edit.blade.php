@extends('adminlte::page')

@section('title', 'Editar Cidade')

@section('content_header')
    <h1>Editar Cidade</h1>
@stop

@section('content')    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p>Os campos com * são obrigatórios</p>
                    <form method="POST" action="{{ route('admin.cities.update', $city->id) }}">
                        @method('PUT')
                        @include('admin.cities.partials.form')
                    </form>
                </div>
            </div>
        </div>
    </div>    
@stop