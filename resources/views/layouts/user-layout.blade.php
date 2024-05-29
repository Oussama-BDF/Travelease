<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ucwords($title)}} - Explore Morocco</title>
    {{-- @vite(['resources/scss/app2.scss']) --}}
    <link rel="stylesheet" href="{{asset('build/assets/app2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/tiny-slider.css')}}">
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body class="bg-gray">

    @include('components.flashbag')

    @include('layouts.user.header')

    <main>
        {{$slot}}
    </main>

    @include('layouts.user.footer')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/tiny-slider.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
</body>
</html>