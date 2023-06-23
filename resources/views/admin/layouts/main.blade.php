<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('admin/img/icons/icon-48x48.png')}}" />

    <link rel="canonical" href="/" />

    <title>@yield('title')</title>

    @section('vendor_css')
    <link href="{{ mix('admin/css/app.css') }}" rel="stylesheet">
    @show
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
<div class="wrapper">
    @include('admin.layouts.components.sidebar')

    <div class="main">
        @include('admin.layouts.components.navbar')

            @yield('content')
        @include('admin.layouts.components.footer')
    </div>
</div>

@section('script')
<script src="{{mix('/admin/js/app.js')}}"></script>

@show

</body>

</html>
