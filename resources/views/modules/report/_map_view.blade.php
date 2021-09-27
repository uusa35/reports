@if(isset($latitude) && isset($longitude))
    <h3>@lang('general.location')</h3>
    <iframe
        width="100%"
        height="300"
        style="border:0;"
        src = "https://maps.google.com/maps?q={{ $latitude }},{{ $longitude }}&hl=es;z=14&amp;output=embed">
    </iframe>
@endif
