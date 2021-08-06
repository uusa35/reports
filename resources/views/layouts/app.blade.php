<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset(env('THUMBNAIL').'default.svg') }}" rel="shortcut icon" type="image/png">


    <!-- Styles -->
    @if(isRtl())
        <link href="{{ mix('css/app-rtl.css') }}" rel="stylesheet">
    @else
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @endif
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

<div id="app">
    @include('partials.nav')
    <main class="py-4">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    @include('partials.notification')
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
            @yield('content')
        </div>
    </main>
</div>
</body>
@section('scripts')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
@show
</html>
