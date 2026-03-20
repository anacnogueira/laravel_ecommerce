<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:site_name" content="Maya Cosméticos"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://mayacosmeticos.com.br/"/>
        <meta name="google-adsense-account" content="ca-pub-6851308508710738">
        <link href="/favicon.ico" type="image/x-icon" rel="icon"/>
        <link href="/favicon.ico" type="image/x-icon" rel="shortcut icon"/>
        @yield('meta')
        <title>@yield('title') - Maya Cosméticos</title>
        <!-- Fonts -->
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/frontend.min.css?v=2.0') }}">
        @stack('css')
    </head>
    <body>
        <main>
            <!-- Header -->
            @include('partials.header')
            <!-- Menu -->
            @include('partials.menu')
            <!-- Content -->
            @yield('content')
            <!-- Footer -->
            @include('partials.footer')
        </main>
        <script type="module" src="{{ asset('js/main.js') }}" defer></script>
        <script type="module" src="{{ asset('js/utils/add-to-cart.js') }}" defer></script>
        <script type="module" src="{{ asset('js/utils/remove-from-cart.js') }}" defer></script>
        @stack('scripts')
    </body>
</html>
