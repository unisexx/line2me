<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <base href="{{ url('/') }}/"  />
    <!-- Meta & Css -->
    @include('include.front.meta')
    @stack('css')
</head>

<body id="app-layout">
    <div id="fh5co-page">
        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
        @include('include.front.header')
		<div id="fh5co-main">
            @include('include.front._google_custom_search')
            @yield('content')
		</div>
    </div>
    @php
        viewCounter();
    @endphp
    <!-- JavaScripts -->
    @include('include.front.js')
    @stack('js')
</body>
</html>