@extends('layouts.app')

@section('title', $title)

@section('content')
<ul class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
	<li role='menuitem'><a href="/"><img src="{{ asset('images/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
	<li><a href="{{ route('brand.index') }}">Marcas</a></li>
	<li class="current">{{ $title }}</li>
</ul>
<h1>{{ $title }}</h1>
<div>{{ $description }}</div>
<div class="row">
    <!-- Shoe Products Here -->
</div>
@endsection