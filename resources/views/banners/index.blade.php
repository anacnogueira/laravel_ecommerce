<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Banners</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.core.min.css" integrity="sha512-YQlbvfX5C6Ym6fTUSZ9GZpyB3F92hmQAZTO5YjciedwAaGRI9ccNs4iw2QTCJiSPheUQZomZKHQtuwbHkA9lgw==" crossorigin="anonymous" referrerpolicy="no-referrer" />	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.2.0/css/glide.theme.css" integrity="sha512-Cn5/xnOLSKjVpNCsJZCtgQhxp00FcFnlRwgbSG7WGFq1BVvyG+LoOarjXAq//8Vstyu0Na9wvEKLWR67/wAy3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
		.glide {
			border: 1px solid white;
			width: 900px;
			margin: 0 auto;
		}
	</style>
</head>
<body style="background-color: #000">
	<div class="glide">
	<div class="glide__track" data-glide-el="track">
		<ul class="glide__slides">
			@foreach ($banners as $key =>$banner)
				@php
					$content = !empty($banner->html) ?: 
					"<a href='".$banner->url."'><img src='". url("images/banners/".$banner->image)."' alt='".$banner->name."' width='900' height='480' /></a>";
				@endphp
				<li class="glide__slide"><?php echo $content;?></li>
			@endforeach
		</ul>
		<div class="glide__bullets" data-glide-el="controls[nav]">
			<button class="glide__bullet" data-glide-dir="=0"></button>
			<button class="glide__bullet" data-glide-dir="=1"></button>
			<button class="glide__bullet" data-glide-dir="=2"></button>
		</div>
		<div class="glide__arrows" data-glide-el="controls">
    <button class="glide__arrow glide__arrow--left" data-glide-dir="<">Anterior</button>
    <button class="glide__arrow glide__arrow--right" data-glide-dir=">">Próximo</button>
  </div>
	</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
	<script>
		var glide = new Glide('.glide', {
			focusAt: 'center',
			perView: 1
		})
		glide.mount();
	</script>
</body>
</html>


