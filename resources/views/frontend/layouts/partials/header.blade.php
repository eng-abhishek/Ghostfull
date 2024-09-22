<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ app_name() }} @yield('title', '')</title>

<meta name="description" content="@yield('description', '')">
<meta name="keywords" content="@yield('keywords', '')">
<meta name="author" content="{{config('app.name')}}">

<meta name="robots" content="index follow" />
<link rel="canonical" href="@yield('canonical', url('/'))" />

<link rel="shortcut icon" href="{{asset('storage/logo/'.fevicon_icon())}}"/>
<link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">

@yield('styles')

<noscript>
    <style>
        .hide-script{
            display: contents;
        }
        .hide-noscript{
            display: none;
        }
        .strikethrough{
            text-decoration: line-through;
            pointer-events: none;
        }
        .toast-container{
            bottom: 50px;
        }
    </style>
</noscript>