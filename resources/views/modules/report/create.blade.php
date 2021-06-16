@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4
                            class="display-6 text-center">{{ __('general.create_new_report') }}</h4></div>

                    <div class="card-body">
                        <form method="post" action="{{ route('report.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="report_type_id" value="{{ request()->report_type_id }}">
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right text-danger">{{ __('general.description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"
                                               required autocomplete="description"
                                              autofocus
                                              rows="5"
                                    >{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right text-danger">{{ __('general.address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="address"
                                           class="form-control @error('address') is-invalid @enderror" name="address"
                                           value="{{ auth()->user()->address }}" autocomplete="address" required>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right text-danger">{{ __('general.mobile') }}</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text"
                                           class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                           value="{{ auth()->user()->mobile }}" required autocomplete="mobile"
                                           autofocus>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(!request()->has('report_type_id'))
                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right text-danger">{{ __('general.report_type') }}</label>

                                    <div class="col-md-6">
                                        <select id="inputState" class="form-control" name="report_type_id" required>
                                            <option selected>{{ trans('general.choose_report_type') }}</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.vehicle_no_for_report') }}</label>

                                <div class="col-md-6">
                                    <input id="vehicle_no" type="vehicle_no"
                                           class="form-control @error('vehicle_no') is-invalid @enderror" name="vehicle_no"
                                           value="{{ old('vehicle_no') }}" autocomplete="vehicle_no">

                                    @error('vehicle_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.area') }}</label>

                                <div class="col-md-6">
                                    <input id="area" type="area"
                                           class="form-control @error('area') is-invalid @enderror" name="area"
                                           value="{{ auth()->user()->area }}" autocomplete="area">

                                    @error('area')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.street') }}</label>

                                <div class="col-md-6">
                                    <input id="street" type="street"
                                           class="form-control @error('street') is-invalid @enderror" name="street"
                                           value="{{ auth()->user()->street }}" autocomplete="street">

                                    @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.block') }}</label>

                                <div class="col-md-6">
                                    <input id="block" type="block"
                                           class="form-control @error('block') is-invalid @enderror" name="block"
                                           value="{{ auth()->user()->block }}" autocomplete="block">

                                    @error('block')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.building_no') }}</label>

                                <div class="col-md-6">
                                    <input id="building_no" type="building_no"
                                           class="form-control @error('building_no') is-invalid @enderror" name="building_no"
                                           value="{{ auth()->user()->building_no }}" autocomplete="building_no">

                                    @error('building_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right ">{{ __('general.accident_image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file"
                                           class="form-control @error('image') is-invalid @enderror" name="image"
                                           value=""  autocomplete="image" autofocus>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right ">{{ __('general.driving_license') }} ({{ trans('general.if_exist') }})</label>

                                <div class="col-md-6">
                                    <input id="image_two" type="file"
                                           class="form-control @error('image_two') is-invalid @enderror"
                                           name="image_two"
                                           value=""   autocomplete="image_two" autofocus>
                                    @error('image_two')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.has_injuries') }}</label>
                                <div class="col-6 ">
                                    <div class="col pt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="has_injuries"
                                                   id="inlineRadio1" value="1">
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline ml-5">
                                            <input class="form-check-input" type="radio" name="has_injuries"
                                                   id="inlineRadio1" value="0" checked>
                                            <label class="form-check-label"
                                                   for="inlineRadio1">{{ trans('general.no') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('general.injuries_no') }} ({{ trans('general.if_exist') }})</label>

                                <div class="col-md-6">
                                    <input id="injuries_no" type="injuries_no"
                                           class="form-control @error('injuries_no') is-invalid @enderror"
                                           name="injuries_no"
                                           value="{{ auth()->user()->injuries_no }}" autocomplete="injuries_no"
                                           maxlength="2">
                                    @error('injuries_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{--                            <div class="form-group">--}}
                            {{--                                <label for="address_address">Address</label>--}}
                            {{--                                <input type="text" id="address-input" name="address_address" class="form-control map-input">--}}
                            {{--                                <input type="hidden" name="address_latitude" id="address-latitude" value="0" />--}}
                            {{--                                <input type="hidden" name="address_longitude" id="address-longitude" value="0" />--}}
                            {{--                            </div>--}}
                            {{--                            <div id="address-map-container" style="width:100%;height:400px; ">--}}
                            {{--                                <div style="width: 100%; height: 100%" id="address-map"></div>--}}
                            {{--                            </div>--}}

                            <div class="container">
                                <div class="row text-center">
                                    <div class="col offset-2">
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('general.register') }}
                                        </button>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('home') }}" class="btn btn-secondary">
                                            {{ __('general.cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
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
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });

                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({input: input, map: map, marker: marker, autocomplete: autocomplete});
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({'placeId': place.place_id}, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
        }
    </script>
@stop
