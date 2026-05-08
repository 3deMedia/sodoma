<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
     <!-- Favicon -->
     <link href="{{ asset('images/favicon.jpg')}}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css') }}/secrets.css">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}?v=1.0.0" defer></script>
    <link src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" >
    <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>

</head>

<body class="{{ $class ?? '' }}" style="background-color: #d5d7dd;">

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @php
        $user = auth()->user();
    @endphp


        @include('admin.layouts.sidebar')


    <div class="main-content">

        @include('admin.layouts.navbar')
        <div class="header pb-4 pt-5 pt-lg-8 d-flex align-items-center bg-white">
            <x-auth-validation-errors />
            @isset($status)
                <x-auth-session-status :status="$status" />
            @endisset
        </div>
        <div class="bg-white">
            {{ $slot }}
        </div>

    </div>

    @guest()
        @include('layouts.footers.guest')
    @endguest
    <script src="{{asset('js/datatables.js')}}?v=1.0.0" defer></script>
    <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ mix('js/admin.js') }}?v=1.0.0" defer></script>


    @stack('js')

    <!-- Argon JS -->
    <script defer src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
</body>

</html>
