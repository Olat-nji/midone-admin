<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- <title>Fitchetech - Software Development Company In Lagos</title> --}}

    {{--  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    {{-- <link rel="stylesheet" href="{{ asset('css/app2.css') }}" > --}}
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/alpine.js') }}" defer></script>




    @livewireStyles
    @livewireScripts
    @stack('scripts')
</head>
@include('vendor.sweetalert.alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

<body>

    {{-- @include('main.includes.header') --}}


    {{$slot}}


    {{-- @include('main.includes.footer') --}}
    

    

    
</body>

</html>
