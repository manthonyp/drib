<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Simple Cloud Storage">
    <meta name="keywords" content="drib, drib - Simple Cloud Storage, Mark Anthony Posadas, manthonyp, drib.manthonyp.com">
    <meta name="web_author" content="Mark Anthony Posadas">
	<meta name="robots" content="none">
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url('/')}} ">
	<meta property="og:site_name" content="drib">
	<meta property="og:title" content="drib">
	<meta property="og:description" content="Simple Cloud Storage">
	<meta property="og:image" content="{{ asset('assets/favicon/icon.png') }}">
	<meta property="og:image:width" content="90">
	<meta property="og:image:height" content="90">
    <meta property="og:locale" content="en_PH">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileColor" content="#bdbdbd">
    <meta name="theme-color" content="#bdbdbd">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/favicon/safari-pinned-tab.svg') }}" color="#bdbdbd">
    <link rel="canonical" href="{{ url('/') }}">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

@if (Auth::user()->theme == 'dark')
    <body class="dark-theme">
@else
    <body>
@endif

    <div id="app">
        
        @include('includes.topbar')
        @include('includes.sidebar')

        <main id="main" role="main">
            <div class="content container-fluid h-100 py-3">

                @yield('content')

            </div>

            @include('includes.sideinfo')

        </main>

        @include('includes.messages')
        @include('includes.modals.upload')
        @include('includes.modals.preview')
        @include('includes.modals.share')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    @if (storagePercentage() < 100)
        <script src="{{ asset('js/vendor98C9E7EB7A66F9AE58B223D3F129B.js') }}"></script>
    @else 
        <script src="{{ asset('js/vendor9A8FEF265B72CD8AB1159B445DED3.js') }}"></script>
    @endif
</body> 
</html>