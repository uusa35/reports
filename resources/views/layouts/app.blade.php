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
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    <script>
        function initialize() {

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;


            const latitude = parseFloat(document.getElementById("address-latitude").value) || 29.3187128;
            const longitude = parseFloat(document.getElementById("address-longitude").value) || 47.9971457;

            const map = new google.maps.Map(document.getElementById('address-map'), {
                center: {lat: latitude, lng: longitude},
                zoom: 13
            });
            const marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: {lat: latitude, lng: longitude},
            });

            google.maps.event.addListener(marker, 'drag', function(event) {
                console.log('event', event);
                document.getElementById("address-latitude").value = event.latLng.lat();
                document.getElementById("address-longitude").value = event.latLng.lng();
            });
        }
    </script>
@show
</html>
