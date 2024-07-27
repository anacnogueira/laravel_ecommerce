@extends('layouts.app')

@push('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.core.min.css" integrity="sha512-YQlbvfX5C6Ym6fTUSZ9GZpyB3F92hmQAZTO5YjciedwAaGRI9ccNs4iw2QTCJiSPheUQZomZKHQtuwbHkA9lgw==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.theme.css" integrity="sha512-Cn5/xnOLSKjVpNCsJZCtgQhxp00FcFnlRwgbSG7WGFq1BVvyG+LoOarjXAq//8Vstyu0Na9wvEKLWR67/wAy3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.glide {
			border: 1px solid white;
			width: 900px;
			margin: 0 auto;
		}
	</style>
@endpush


@push('scripts')
	<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
	<script>
		var glide = new Glide('.glide', {
			focusAt: 'center',
			perView: 1
		})
		glide.mount();
	</script>
@endpush

@section('title', 'Banners')

@section('content')
	<div class="glide">
		<div class="glide__track" data-glide-el="track">
			<ul class="glide__slides">
				@php
					$bullets = [];
				@endphp
				@foreach ($banners as $key => $banner)
					@php					
						$bullets[$key] = "<button class='glide__bullet' data-glide-dir='=$key'></button>";
						$content = !empty($banner->html) ?: 
						"<a href='".$banner->url."'><img src='". Storage::url($banner->image)."' alt='".$banner->name."' width='900' height='480' /></a>";
					@endphp
					<li class="glide__slide">{!! $content !!}</li>
				@endforeach
			</ul>
			<div class="glide__bullets" data-glide-el="controls[nav]">
				@foreach ($bullets as $bullet)
				{!! $bullet !!}
				@endforeach
			</div>
			<div class="glide__arrows" data-glide-el="controls">
				<button class="glide__arrow glide__arrow--left" data-glide-dir="<">Anterior</button>
				<button class="glide__arrow glide__arrow--right" data-glide-dir=">">Próximo</button>
			</div>
		</div>
	</div>
@endsection	
	


