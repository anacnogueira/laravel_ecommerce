@extends('layouts.app')

@php
    $relativeUrl = str_replace("https://mayacosmeticos.com.br","", $url);
    $follow = ($product->current_stock <= 0 || $product->status == 'N') ? "nofollow, noindex" : "follow, index";
@endphp


@section('meta')
    <meta name="robots" content="{{ $follow }}"/>
    <meta name="description" content="{{ $product->description }}"/>
    <meta property="og:title" content="{{ $product->meta_title }}"/>
    <meta property="og:description" content="{{ $product->description }}"/>
    @if (count($product->photos) > 0)
        <meta property="og:image" content="{{ Storage::url($product->photos[0]->photo_ori) }}"/>
    @endif
    <link href="{{ $url }}" rel="canonical"/>
@endsection

@section('title', $product->meta_title)

@section('content')
    <div class="container">
        <div id="fb-root"></div>
        <nav class="breadcrumb">
            <ul>
                <li><a href="/"><img src="{{ asset('img/i-home.png') }}" alt="Página Inicial" title="Página Inicial"></a></li>
                @foreach ($product->categories as $category)
                    <li><a href="/categorias/{{ $category->permalink }}">{{ $category->name }}</a></li>
                @endforeach
                <li><span>{{ $product->name }}</span></li>
            </ul>
        </nav>
        <div class="product">
            <section>
                @include('partials.products.images')
                @if ($product->promotion)
                    <div class='price-off'>{{ $product->promotion->percent_promotion }} % desconto</div>
                @endif
                @include('partials.products.action-buttons')
            </section>
            <section itemscope itemtype="http://data-vocabulary.org/Product">
                <h1 id="product-name"itemprop="name">{{ $product->name }}</h1>
                <h2 id="product-brand-name">{{ $product->brand->name }}</h2>
                @inject('rate', 'App\Services\StarRatingService')
                {{  $rate->averageProductRated($product->rate); }}
                <hr />
                @include('partials.products.price')
                <div class="sharethis-inline-share-buttons"></div>
                 @include('components.shipping')
                 {{  $rate->rate($product->id, $comments) }}
            </section>
        </div>
        <hr />
        <p>Código: {{ $product->code }}</p>
        {!! $product->text !!}
        @include('partials.comments.list-comments')
    </div>
@endsection

@push("css")
    <link rel="stylesheet" href="{{ asset('css/page/product.css') }}">

@endpush


@push('scripts')
    <script type="text/javascript" src="{{ asset("js/components/img-gallery.js") }}"></script>
    <script type="text/javascript" src="{{ asset("js/utils/add-by-whatsapp-button.js?v=2.0") }}"></script>
    @if ($product->current_stock == 0 && $product->status == 'N')
        <script type="text/javascript" src="{{ asset("js/utils/send-product-notification-form.js") }}"></script>
    @endif
    <script type="application/ld+json">
        @json($schema)
    </script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e0b58b2e13da80012ea3427&product=inline-share-buttons&cms=sop' async='async'></script>
    <script type="text/javascript">
        (function() {
            var e = document.createElement('script');
            e.src = document.location.protocol + '//connect.facebook.net/pt_BR/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);
        }());
        window.fbAsyncInit = function () {
            FB.init({
                appId  : '305474179629322',
                channelUrl : window.location.protocol + "//" + window.location.hostname + "/fb-channel.html",
                status : false,
                cookie : false,
                xfbml  : true
            });
        };
        document.getElementById('share-button').addEventListener("click", (e) => {
            e.preventDefault();
            FB.ui({
                method: "feed",
                name: "{{ $product->name }}",
                link: "https://mayacosmeticos.com.br/item/{{ $categoriesAndSlug }}",
                picture: "{{ env('APP_URL') . Storage::url($product->photos[0]->photo_ori) }}",
                caption: "{{ $product->description }}",
                description: "{{ $product->description }}"
            });
        });
        </script>
        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">stLight.options({publisher: "44841ba7-ef9e-48aa-a6ff-196456a8f872", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
        <script type="text/javascript" src="{{ asset("js/utils/star-rating.min.js") }}"></script>
        <script type="text/javascript" src="{{ asset("js/utils/rater.js") }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.6.1/imask.min.js" integrity="sha512-+3RJc0aLDkj0plGNnrqlTwCCyMmDCV1fSYqXw4m+OczX09Pas5A/U+V3pFwrSyoC1svzDy40Q9RU/85yb/7D2A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="{{ asset('js/utils/mask-field.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/components/shipping-calculate.js') }}"></script>
        <script type="module" src="{{ asset('js/components/rate.js') }}" defer></script>
@endpush
