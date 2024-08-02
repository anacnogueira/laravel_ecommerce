@extends('layouts.app')

@section('title', $title)

@section('content')
<ul class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
	<li role='menuitem'><a href="/"><img src="{{ asset('images/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
	<li class="current">{{ $title }}</li>
</ul>
<h1>{{ $title }}</h1>
<div>
    @if(isset($brands))
        @foreach($brands as $brand)
			  <div>
                <div>
                    <div class="img">
                        <a href="{{ route('brand.show', $brand->permalink) }}">
                        @if (!empty($brand->image)) 
                            <img src="{{ Storage::url($brand->image) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}">     
                        @else
                            <div><h2>{{ $brand->name }}</h2></div>
                        @endif
                    </div>
                </div>
              </div>  
			
	    @endforeach
    @endif
</div>
@endsection